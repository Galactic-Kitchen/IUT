package fr.kanoulier.bakefile.structure.tree;

import java.util.Date;
import java.util.Iterator;
import java.util.LinkedList;
import java.util.List;

/**
 * Represente un Noeud dans l'arbre des dependances
 * 
 * Extension de FileNode implémentant la gestion des dépendances
 * 
 * @author Maxence Raymond
 * @version 1.7
 */
public class DependencyNode extends FileNode {
    private List<DependencyNode> dependenciesNodes = new LinkedList<>();

    /**
     * {@inheritDoc}
     * 
     * @param name    {@inheritDoc}
     * @param command {@inheritDoc}
     */
    public DependencyNode(String name, String[] command) {
        super(name, command);
    }

    /**
     * {@inheritDoc}
     * 
     * @param name {@inheritDoc}
     */
    public DependencyNode(String name) {
        super(name);
    }

    /**
     * Permet d'ajouter une dépendance à ce noeud
     * 
     * @param node La dependance a ajouter
     */
    public void addDependency(DependencyNode node) {
        this.dependenciesNodes.add(node);
    }

    /**
     * Permet de savoir s'il y a des dépendances
     * 
     * @return true s'il y a des dépendances
     */
    public boolean hasDependencies() {
        return !this.dependenciesNodes.isEmpty();
    }

    /**
     * indique si ce noeud a besoin d'être reconstruit
     * 
     * 
     * peut être causé par l'absence de sa cible, une source mise à jour ou
     * une des dépendances qui a changé
     * 
     * @return true s'il est nécessaire de reconstruire ce noeud
     */
    public boolean needsRebuild() {
        return this.needsRebuild(false);
    }

    /**
     * indique si ce noeud a besoin d'être reconstruit
     * 
     * 
     * peut être causé par l'absence de sa cible, une source mise à jour ou
     * une des dépendances qui a changé
     * 
     * @param debugState l'etat du mode debug
     * @return true s'il est nécessaire de reconstruire ce noeud
     */
    public boolean needsRebuild(boolean debugState) {
        if (!this.exists()) {
            return true;
        }
        if (this.dependenciesNodes.isEmpty()) {
            return false;
        }
        return this.recursivecompare(this.getDate(), debugState, new LinkedList<DependencyNode>());
    }

    /**
     * Méthode recursive pour comparer les dates
     * 
     * Tolère les dépendances circulaires
     * 
     * @param date       Date avec quoi comparer
     * @param debugState L'état du mode debug
     * @param visited    La liste des noeuds visités
     * @return true si un des noeuds est plus récent que le noeud de base
     * @hidden
     */
    protected final boolean recursivecompare(Date date, boolean debugState, List<DependencyNode> visited) {
        if (visited.contains(this)) {
            return false;
        }
        visited.add(this);
        for (DependencyNode node : this.dependenciesNodes) {
            boolean value = node.recursivecompare(this.getDate(), debugState, visited);
            if (debugState) {
                System.out.println("Comparaison entre le noeud " + this.getFileName() + " et le noeud "
                        + node.getFileName() + ". Rebuild nécessaire : " + (value ? " Oui " : "Non"));
            }
            if (value) {
                return value;
            }
        }
        return this.getDate().after(date);
    }

    /**
     * Retourne les dépendances directes du Noeud
     * 
     * @return peut ne contenir aucun élément
     */
    public Iterator<DependencyNode> getDirectDependencies() {
        return this.dependenciesNodes.iterator();
    }

}