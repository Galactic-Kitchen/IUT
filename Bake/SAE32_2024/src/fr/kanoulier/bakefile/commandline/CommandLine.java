package fr.kanoulier.bakefile.commandline;

import fr.kanoulier.bakefile.structure.File;

/**
 * 
 * @author Marco Orfao
 * @version 1.2
 */
public class CommandLine {

    private File<String> toUpdateList = null;

    private boolean debug = false;

    /**
     * Constructeur de la classe, il traite les arguments de la ligne de commande.
     * 
     * @param argFile Fichier contenant les arguments de la ligne de commande.
     */
    public CommandLine(String[] args) {

        this.toUpdateList = new File<String>();

        for (String arg : args) {
            if (arg.charAt(0) == '-') {
                this.debug = new Options(arg).getDebug();

            } else {
                this.toUpdateList.enqueue(arg);
            }
        }
    }

    /**
     * méthode permettant de récupérer l'état du mode debug.
     * 
     * @return true si le mode debug est activé, false sinon.
     */
    public boolean getDebug() {
        return this.debug;
    }

    /**
     * méthode permettant de récupérer la liste des fichiers à mettre à jour.
     * 
     * @return la liste des fichiers à mettre à jour.
     */
    public File<String> getToUpdateList() {
        if (this.toUpdateList.isEmpty()) {
            return null;
        } else {
            return this.toUpdateList;
        }
    }
}