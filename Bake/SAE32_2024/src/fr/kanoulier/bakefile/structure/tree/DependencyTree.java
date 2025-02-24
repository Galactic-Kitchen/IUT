package fr.kanoulier.bakefile.structure.tree;

import java.util.HashMap;
import java.util.Iterator;
import java.util.Map;

/**
 * Classe servant à représenter le graphe des dépendances
 * 
 * @author Maxence Raymond, Marco Orfao
 * @version 1.6
 */
public class DependencyTree {
    private final Map<String, DependencyNode> dico;

    /** etat du mode debug */
    protected boolean debugstate = false;

    /**
     * Cree un arbre de dépendances vide
     */
    public DependencyTree() {
        this.dico = new HashMap<>();
    }

    /**
     * Cree un arbre de dépendances vide
     * 
     * @param state L'etat du mode debug
     */
    public DependencyTree(boolean state) {
        this();
        this.debugstate = state;
    }

    /**
     * Méthode principale permettant d'ajouter un noeud à l'arbre
     * 
     * remplace le noeud s'il est déjà existant dans l'arbre
     * 
     * @param node le noeud a ajouter
     */
    public void add(TransitNode node) {
        if (node == null) {
            throw new NullPointerException();
        }
        String identifier = node.getFileName();
        DependencyNode newNode = null;
        if (this.dico.containsKey(identifier)) {
            newNode = this.dico.get(identifier);
            if (!newNode.hasCommand()) {
                newNode.setCommand(node.getCommand());
            }
        } else {
            newNode = new DependencyNode(identifier, node.getCommand());
            this.dico.put(identifier, newNode);
        }
        for (String name : node.getDependenciesNames()) {
            newNode.addDependency(this.createOrContains(name));
        }
    }

    private DependencyNode createOrContains(String identifier) {
        if (!this.dico.containsKey(identifier)) {
            this.dico.put(identifier, new DependencyNode(identifier));
        }
        return this.dico.get(identifier);
    }

    /**
     * Permet de savoir si une dépendance est déjà présente pour un fichier
     * 
     * @param identifier le nom du fichier
     * @return si le fichier est présent ou non
     * @throws IllegalArgumentException si identifier est incorrect
     */
    public boolean contains(String identifier) {
        if (identifier == null || identifier.isBlank()) {
            throw new IllegalArgumentException();
        }
        return this.dico.containsKey(identifier);
    }

    /**
     * Permet de récupérer un noeud de l'arbre
     * 
     * @param identifier L'identifiant du noeud à récupérer
     * @return Noeud pouvant contenir ou non des dépendances ainsi qu'ou non une
     *         commande.
     */
    public DependencyNode getNode(String identifier) {
        return this.dico.get(identifier);
    }

    /**
     * Permet de récupérer l'entièreté des dépendances d'un noeud
     * 
     * Ne fait pas d'opérations sur les dates ni sur les Phony, gère uniquement les
     * dépendances circulaires
     * 
     * @param identifier L'identifiant du noeud sur lequel récupérer les dépendances
     * @return {@link NodeIterator} si plusieurs dépendances sont présentes
     */
    public Iterator<FileNode> getDependenciesFor(String identifier) {
        if (identifier == null || identifier.isBlank()) {
            throw new IllegalArgumentException("Please provide a correct identifier");
        } else if (!this.dico.containsKey(identifier)) {
            throw new IllegalStateException("Node doesn't exist");
        }
        return new NodeIterator(this.dico.get(identifier), this.debugstate);
    }

    /**
     * Permet de récupérer l'entièreté des dépendances d'un noeud devant être
     * reconstruites
     * 
     * Gère les dépendances circulaires, les buts Phony et les comparaisons de date
     * des fichiers
     * 
     * @param identifier L'identifiant du noeud sur lequel récupérer les dépendances
     * @return {@link NodeIterator} si plusieurs dépendances sont présentes
     */
    public Iterator<FileNode> getDependenciesToBuildFor(String identifier) {
        if (identifier == null || identifier.isBlank()) {
            throw new IllegalArgumentException("Please provide a correct identifier");
        } else if (!this.dico.containsKey(identifier)) {
            throw new IllegalStateException("Node doesn't exist");
        }
        return new TimeNodeIterator(this.dico.get(identifier), this.debugstate);
    }

    /**
     * Permet de récupérer les dépendances directes d'un noeud
     * 
     * @param identifier l'identifiant du noeud
     * @return null s'il n'y a aucune dépendance
     */
    public Iterator<DependencyNode> getDirectDependenciesOf(String identifier) {
        if (identifier == null || identifier.isBlank()) {
            throw new IllegalArgumentException("Please provide a correct identifier");
        } else if (!this.dico.containsKey(identifier)) {
            throw new IllegalStateException("Node doesn't exist");
        } else if (!this.dico.get(identifier).hasDependencies()) {
            return null;
        }
        return this.dico.get(identifier).getDirectDependencies();
    }

    /**
     * Permet la gestion des méthodes phony
     * 
     * Inverse l'état Phony, fortement conseillé de regarder l'état auparavant via
     * {@link isPhony}
     * 
     * @param identifier l'identifiant du noeud
     */
    public void setPhony(String identifier) {
        if (identifier == null || identifier.isBlank()) {
            throw new IllegalArgumentException("Please provide a correct identifier");
        } else if (!this.dico.containsKey(identifier)) {
            throw new IllegalStateException("Node doesn't exist");
        }
        DependencyNode node = this.dico.get(identifier);
        node.setPhony(node.isPhony() ? false : true);
    }

    /**
     * Permet la gestion des méthodes phony
     * 
     * @param identifier l'identifiant du noeud
     * @return si le noeud est considéré comme phony ou non
     */
    public boolean isPhony(String identifier) {
        if (identifier == null || identifier.isBlank()) {
            throw new IllegalArgumentException("Please provide a correct identifier");
        } else if (!this.dico.containsKey(identifier)) {
            throw new IllegalStateException("Node doesn't exist");
        }
        return this.dico.get(identifier).isPhony();
    }
}