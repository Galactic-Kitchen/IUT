package fr.kanoulier.bakefile.structure.tree;

import java.util.List;
import java.util.NoSuchElementException;
import java.util.ArrayList;
import java.util.Iterator;

/**
 * Classe servant à mettre en place l'algorithme de parcours de l'arbre de
 * manière ordonnée
 * 
 * Implémentation gérant les buts phony et les dépendances ciruclaires
 * 
 * @see fr.kanoulier.bakefile.structure.tree.TimeNodeIterator Pour la gestion
 *      des dates
 * 
 * @author Maxence Raymond
 * @version 1.5
 */
public class NodeIterator implements Iterator<FileNode> {
    /** Liste ordonnée des dépendances du noeud de base */
    protected List<DependencyNode> list;
    /** Listes des noeuds sur lesquels l'algorithme est déjà passé */
    protected List<DependencyNode> inConsideration;
    /** Noeud de base */
    protected final DependencyNode root;
    private Iterator<DependencyNode> iterator = null;
    /** etat du mode debug */
    protected boolean debug = false;

    /**
     * Constructeur de base
     * 
     * @param node noeud sur lequel effectuer une recherche
     */
    public NodeIterator(DependencyNode node) {
        this.list = new ArrayList<>();
        this.inConsideration = new ArrayList<>();
        this.root = node;
    }

    /**
     * Constructeur prenant en charge le mode debug
     * 
     * @param dependencyNode noeud sur lequel effectuer une recherche
     * @param debugstate     état du mode debug
     */
    public NodeIterator(DependencyNode dependencyNode, boolean debugstate) {
        this(dependencyNode);
        this.debug = debugstate;
    }

    private void create() {
        this.recursivecreate(root);
        this.iterator = list.iterator();
    }

    /**
     * Méthode récursive à redéfinir pour une nouvelle gestion des dépendances
     * 
     * Utilise les paramètres de classe inConsideration et list
     * 
     * @param current Le noeud concerné
     */
    protected void recursivecreate(DependencyNode current) {
        if (this.list.contains(current) || this.inConsideration.contains(current)) {
            // Le fichier a déjà été traité ou n'est pas à traiter
            return;
        }
        this.inConsideration.add(current);
        if (current.hasDependencies()) {
            Iterator<DependencyNode> seeker = current.getDirectDependencies();
            while (seeker.hasNext()) {
                this.recursivecreate(seeker.next());
            }
        }
        if (this.debug) {
            System.out.println("Considering rebuilding : " + current.getFileName());
        }
        list.add(current);
    }

    /**
     * Retourne les dépendances sous la forme d'un tableau
     * 
     * @return à minima 1 élément
     */
    public DependencyNode[] toArray() {
        return (DependencyNode[]) this.list.toArray();
    }

    @Override
    public boolean hasNext() {
        if (this.iterator == null) {
            this.create();
        }
        return this.iterator.hasNext();
    }

    @Override
    public DependencyNode next() {
        if (!this.hasNext()) {
            throw new NoSuchElementException("No more nodes left");
        }
        return this.iterator.next();
    }

}
