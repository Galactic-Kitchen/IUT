const express = require("express");
const { MongoClient, ObjectId } = require("mongodb");
const app = express();

app.use(express.json());

app.use((req, res, next) => {
  res.setHeader("Access-Control-Allow-Origin", "*");
  res.setHeader(
    "Access-Control-Allow-Methods",
    "GET, POST, PUT, DELETE, OPTIONS"
  );
  res.setHeader("Access-Control-Allow-Headers", "Content-Type, Authorization");

  if (req.method === "OPTIONS") {
    res.sendStatus(204);
    return;
  }

  next();
});

const mongoUri = `mongodb://${process.env.MONGO_USER}:${process.env.MONGO_PASSWORD}@${process.env.DB_HOST}:27017`;
const client = new MongoClient(mongoUri, { useUnifiedTopology: true });

let db = null;

async function connectToMongo() {
  if (!db) {
    await client.connect();
    db = client.db(process.env.MONGO_DATABASE);
  }
  return db;
}

app.post("/notes", async (req, res) => {
  const { title, contenu } = req.body;
  try {
    const db = await connectToMongo();
    const result = await db.collection("notes").insertOne({ title, contenu });
    res.location(`/notes/${result.insertedId}`);
    res.status(201).json({ id: result.insertedId, title, contenu });
  } catch (err) {
    res.status(500).json({ error: "Failed to create note" });
  }
});

app.get("/notes", async (req, res) => {
  try {
    const db = await connectToMongo();
    const notes = await db
      .collection("notes")
      .find({}, { projection: { _id: 1, title: 1 } })
      .toArray();
    res.status(200).json(notes);
  } catch (err) {
    res.status(500).json({ error: "Failed to fetch notes" });
  }
});

app.get("/notes/:id", async (req, res) => {
  const id = req.params.id;
  try {
    const db = await connectToMongo();
    const note = await db
      .collection("notes")
      .findOne({ _id: new ObjectId(id) });
    if (!note) {
      return res.status(404).json({ error: "Note not found" });
    }
    res.status(200).json(note);
  } catch (err) {
    console.log(err);
    res.status(500).json({ error: "Failed to fetch note" });
  }
});

app.put("/notes/:id", async (req, res) => {
  const id = req.params.id;
  const { title, contenu } = req.body;
  try {
    const db = await connectToMongo();
    await db
      .collection("notes")
      .updateOne({ _id: new ObjectId(id) }, { $set: { title, contenu } });
    res.status(200).json({ id, title, contenu });
  } catch (err) {
    res.status(500).json({ error: "Failed to update note" });
  }
});

app.delete("/notes/:id", async (req, res) => {
  const id = req.params.id;
  try {
    const db = await connectToMongo();
    await db.collection("notes").deleteOne({ _id: new ObjectId(id) });
    res.status(204).send();
  } catch (err) {
    res.status(500).json({ error: "Failed to delete note" });
  }
});

app.listen(3000, () => {
  console.log(`Listening on *:${3000}`);
});
