package fr.kanoulier.bakefile;

import java.io.IOException;
import java.io.BufferedReader;
import java.io.FileReader;

/**
 * Cette classe va permettre de lire les lignes d'un fichier
 * 
 * @author Marco Orfao
 * @version 1.0
 */
public class LineReader {

    private BufferedReader reader;

    private String line;

    /**
     * Constructeur de la classe, il ouvre le fichier à lire
     * 
     * @param path Chemin du fichier à lire
     */
    public LineReader(String path) {

        try {
            FileReader file = new FileReader(path);

            this.reader = new BufferedReader(file);

        } catch (IOException e) {
            System.out.println("Erreur lors de l'ouverture du fichier");
        }
    }

    /**
     * méthode permettant de récupérer la ligne courante
     * 
     * @return la ligne courante
     */
    public String getLine() {
        return this.line;
    }

    /**
     * méthode permettant de passer à la ligne suivante
     * 
     * @return la ligne suivante
     */
    public String nextLine() {
        try {
            this.line = this.reader.readLine();
            return this.line;
        } catch (IOException e) {
            System.out.println("Erreur lors de la lecture du fichier");
            return null;
        }
    }

    /**
     * méthode permettant de fermer le fichier
     */
    public void close() {
        try {
            this.reader.close();
        } catch (IOException e) {
            System.out.println("Erreur lors de la fermeture du fichier");
        }
    }

}
