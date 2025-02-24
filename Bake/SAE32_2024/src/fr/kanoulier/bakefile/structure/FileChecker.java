package fr.kanoulier.bakefile.structure;

import java.util.Date;

/**
 * Classe regroupant des méthodes statiques pour interagir avec le système de
 * fichiers
 * 
 * @author Maxence Raymond
 * @version 1.1
 */
public class FileChecker {

    /**
     * Permet de vérifier l'état d'un fichier
     * 
     * @param pathname le chemin vers le fichier
     * @return true si le fichier existe et est lisible, false sinon
     */
    public static final boolean fileExists(String pathname) {
        java.io.File fichier = new java.io.File(pathname);
        if (fichier.exists()) {
            if (fichier.isFile() && fichier.canRead()) {
                return true;
            }
        }
        return false;
    }

    /**
     * Permet d'obtenir la date d'un fichier
     * 
     * @param pathname le chemin vers le fichier
     * @return la date Posix si l'accès à la date du fichier n'est pas possible
     */
    public static final Date getFileDate(String pathname) {
        java.io.File fichier = new java.io.File(pathname);
        return new Date(fichier.lastModified());
    }

}
