package fr.kanoulier.bakefile.structure.tree;

import java.util.ArrayList;
import java.util.List;

/**
 * Classe servant à gérer la création d'un noeud
 * 
 * @author Maxence Raymond
 * @version 1.2
 */
public class TransitNode extends AbstractNode {
    /** Liste du nom des dépendances */
    protected List<String> dependenciesNames = null;

    /**
     * Constructeur avancé
     * 
     * @param name    le nom du noeud
     * @param command un tableau de lignes de commandes
     */
    public TransitNode(String name, String[] command) {
        super(name, command);
        this.dependenciesNames = new ArrayList<>();
    }

    /**
     * Constructeur de base
     * 
     * @param name le nom du noeud
     */
    public TransitNode(String name) {
        super(name);
        this.dependenciesNames = new ArrayList<>();
    }

    /**
     * Retourne les dépendances
     * 
     * @return une liste du nom des dépendances
     */
    public List<String> getDependenciesNames() {
        return this.dependenciesNames;
    }

    /**
     * Ajoute une dépendance
     * 
     * @param identifier le nom de la dépendance
     */
    public void addDependency(String identifier) {
        this.dependenciesNames.add(identifier);
    }

}
