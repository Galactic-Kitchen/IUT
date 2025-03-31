document.addEventListener("DOMContentLoaded", () => {
  const notesButton = document.getElementById("notesButton");
  const saveButton = document.getElementById("save");
  const backButton = document.getElementById("back");
  const clearButton = document.getElementById("clearButton");
  const notesList = document.getElementById("notesList");
  const titleInput = document.getElementById("title");
  const noteText = document.getElementById("note");

  // Redirection vers la page des notes pour ajouter une nouvelle note
  if (notesButton) {
    notesButton.addEventListener("click", () => {
      window.location.href = "notes.html";
    });
  }

  // Sauvegarder une note et rediriger vers l'index
  if (saveButton) {
    saveButton.addEventListener("click", async (event) => {
      console.log("saveButton clicked");
      event.preventDefault();
      const title = titleInput.value.trim();
      const contenu = noteText.value.trim();

      if (title && contenu && urlParams.get("id") === null) {
        const noteData = { title, contenu };
        try {
          const response = await fetch("http://localhost:3000/notes", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(noteData),
          });
          if (response.ok) {
            window.location.href = "index.html";
          } else {
            alert("Failed to save note");
          }
        } catch (error) {
          console.error("Error saving note:", error);
        }
      } else {
        alert("Please fill in both title and content.");
      }
    });
  }

  // Retour à l'index sans sauvegarder
  if (backButton) {
    backButton.addEventListener("click", () => {
      window.location.href = "index.html";
    });
  }

  // Effacer les champs de texte
  if (clearButton) {
    clearButton.addEventListener("click", (event) => {
      event.preventDefault();
      noteText.value = "";
    });
  }

  // Charger et afficher les notes depuis le backend
  if (notesList) {
    const loadNotes = async () => {
      try {
        const response = await fetch("http://localhost:3000/notes");
        if (response.ok) {
          const notes = await response.json();
          notesList.innerHTML = "";
          notes.forEach((note) => {
            const li = document.createElement("li");
            const div = document.createElement("div");
            const h3 = document.createElement("h3");
            h3.textContent = note.title;
            const editButton = document.createElement("button");
            editButton.textContent = "Edit";
            editButton.addEventListener("click", () => {
              window.location.href = `notes.html?id=${note._id}`;
            });
            const deleteButton = document.createElement("button");
            deleteButton.textContent = "Delete";
            deleteButton.addEventListener("click", async () => {
              try {
                const response = await fetch(
                  `http://localhost:3000/notes/${note._id}`,
                  {
                    method: "DELETE",
                  }
                );
                if (response.ok) {
                  loadNotes(); // Recharger la liste après suppression
                } else {
                  alert("Failed to delete note");
                }
              } catch (error) {
                console.error("Error deleting note:", error);
              }
            });
            div.appendChild(h3);
            div.appendChild(editButton);
            div.appendChild(deleteButton);
            li.appendChild(div);
            notesList.appendChild(li);
          });
        } else {
          alert("Failed to load notes");
        }
      } catch (error) {
        console.error("Error loading notes:", error);
      }
    };
    loadNotes();
  }

  // Modifier une note
  if (window.location.search.includes("id=")) {
    const urlParams = new URLSearchParams(window.location.search);
    const noteId = urlParams.get("id");
    console.log("Editing note with id:", noteId);

    const loadNoteToEdit = async () => {
      try {
        const response = await fetch(`http://localhost:3000/notes/${noteId}`);
        if (response.ok) {
          const note = await response.json();
          titleInput.value = note.title;
          noteText.value = note.contenu;
        } else {
          alert("Failed to load note for editing");
        }
      } catch (error) {
        console.error("Error loading note:", error);
      }
    };

    loadNoteToEdit();

    saveButton.addEventListener("click", async (event) => {
      console.log("Updating note with id:", noteId);
      event.preventDefault();
      const title = titleInput.value.trim();
      const contenu = noteText.value.trim();

      if (title && contenu && urlParams.get("id") !== null) {
        const updatedNote = { title, contenu };
        try {
          const response = await fetch(
            `http://localhost:3000/notes/${noteId}`,
            {
              method: "PUT",
              headers: { "Content-Type": "application/json" },
              body: JSON.stringify(updatedNote),
            }
          );
          if (response.ok) {
            window.location.href = "index.html";
          } else {
            alert("Failed to update note");
          }
        } catch (error) {
          console.error("Error updating note:", error);
        }
      } else {
        alert("Please fill in both title and content.");
      }
    });
  }
});
