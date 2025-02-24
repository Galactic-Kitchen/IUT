package fr.kanoulier.bakefile.structure.tree;

import java.util.Date;

import fr.kanoulier.bakefile.structure.FileChecker;

/**
 * Représente un fichier dans l'arbre
 * 
 * Sert à implémenter les méthodes gérant la date et l'état du fichier concerné
 * principalement
 * 
 * @author Maxence Raymond
 * @version 1.8
 */
public class FileNode extends AbstractNode {
    /** date du fichier si vérifié, null sinon ou si le fichier n'existe pas */
    protected Date timeStamp;
    private boolean exists;
    private boolean verified;

    /**
     * {@inheritDoc}
     * 
     * @param name    {@inheritDoc}
     * @param command {@inheritDoc}
     */
    public FileNode(String name, String[] command) {
        super(name, command);
    }

    /**
     * {@inheritDoc}
     * 
     * @param name {@inheritDoc}
     */
    public FileNode(String name) {
        super(name);
    }

    /**
     * Permet de récupérer la date du fichier
     * 
     * La date n'étant pas modifiable, un clone est retourné
     * 
     * @return le temps 0 Posix si le fichier n'est pas accessible ou n'existe pas
     */
    public Date getDate() {
        if (!this.exists()) {
            return new Date(0);
        }
        return (Date) this.timeStamp.clone();
    }

    /**
     * Retourne si le fichier existe actuellement
     * 
     * @return true si le fichier existe
     */
    public boolean exists() {
        if (this.verified == false || this.timeStamp == null) {
            this.check();
        }
        return this.exists;
    }

    private void check() {
        this.verified = true;
        if (this.isPhony) {
            this.exists = false;
            return;
        }
        this.exists = FileChecker.fileExists(this.getFileName());
        if (this.exists) {
            this.timeStamp = FileChecker.getFileDate(this.getFileName());
        }
    }

    /**
     * Retourne si le but a besoin d'être reconstruit
     * 
     * @return si le noeud a besoin d'être reconstruit
     */
    public boolean needsRebuild() {
        return !this.exists();
    }
}