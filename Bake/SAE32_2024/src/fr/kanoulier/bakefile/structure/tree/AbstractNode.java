package fr.kanoulier.bakefile.structure.tree;

/**
 * Classe représentant un noeud de base
 * 
 * @author Maxence Raymond
 * @version 1.6
 */
public abstract class AbstractNode {
    /** nom et chemin du fichier */
    protected String name;
    /** tableau de lignes de commandes pour l'objectif */
    protected String[] command = null;
    /** etat du mode phony */
    protected boolean isPhony = false;

    /**
     * Createur abstrait de la classe
     * 
     * @param name Le nom de la target
     */
    public AbstractNode(String name) {
        this.name = name;
    }

    /**
     * Createur abstrait de la classe
     * 
     * @param name    Le nom de la target
     * @param command Chaque élément du tableau représente une ligne de commande
     */
    public AbstractNode(String name, String[] command) {
        this.name = name;
        this.command = command;
    }

    /**
     * Retourne le nom du fichier fourni
     * 
     * @return le nom de l'objectif
     */
    public String getFileName() {
        return name;
    }

    /**
     * Met à jour le mode Phony
     * 
     * @param state le nouvel état
     */
    public void setPhony(boolean state) {
        this.isPhony = state;
    }

    /**
     * Retourne l'état Phony
     * 
     * @return true si le mode Phony est activé pour ce noeud
     */
    public boolean isPhony() {
        return this.isPhony;
    }

    /**
     * Le nom de ce noeud
     */
    @Override
    public String toString() {
        return this.name;
    }

    /**
     * Permet de récupérer la commande, peut renvoyer null si la commande n'a pas
     * été attribuée
     * 
     * @return Chaque élément du tableau représente une ligne de commande
     */
    public String[] getCommand() {
        return this.command;
    }

    /**
     * Permet de mettre à jour la commande, si une commande existait déjà elle sera
     * effacée
     * 
     * @param command Chaque élément du tableau représente une ligne de commande
     */
    public void setCommand(String[] command) {
        this.command = command;
    }

    /**
     * Permet de si une commande a déjà été attribuée, qu'elle soit valide ou non
     * 
     * @return l'état actuel de la commande
     */
    public boolean hasCommand() {
        return this.command != null;
    }
}