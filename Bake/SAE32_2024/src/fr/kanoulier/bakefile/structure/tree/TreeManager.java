package fr.kanoulier.bakefile.structure.tree;

import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;

/**
 * Classe permettant de simplifier la création des noeuds
 * 
 * Sert principalement à éviter la création directe d'un noeud
 * 
 * @author Maxence Raymond, Marco Orfao
 * @version 1.6
 */
public class TreeManager {
    private final DependencyTree tree;

    private String target;
    private ArrayList<String> commands;
    private ArrayList<String> dependencies;

    /**
     * Constructeur par défaut
     * Mode debug désactivé
     */
    public TreeManager() {
        this(false);
    }

    /**
     * Createur de base
     * 
     * @param debug l'etat du mode debug a activer ou non
     */
    public TreeManager(boolean debug) {
        this.tree = debug ? new DependencyTree(true) : new DependencyTree();
        this.dependencies = new ArrayList<String>();
        this.commands = new ArrayList<String>();
        this.target = null;
    }

    /**
     * Retourne l'arbre créé
     * 
     * @return l'arbre créé
     */
    public DependencyTree getTree() {
        return this.tree;
    }

    /**
     * Finalise l'ajout d'un noeud dans l'arbre
     */
    public void push() {
        if (target.isBlank()) {
            throw new IllegalStateException("Target isn't valid");
        }
        TransitNode node = new TransitNode(target, commands.toArray(new String[0]));
        for (String dependency : this.dependencies) {
            node.addDependency(dependency);
        }
        this.tree.add(node);
        this.flush();
    }

    /**
     * Nettoie les entrées concernant l'ajout d'un noeud dans l'arbre
     */
    public void flush() {
        this.target = null;
        this.dependencies.clear();
        this.commands.clear();
    }

    /**
     * Met à jour le but du noeud allant être créé
     * 
     * @param target l'identifiant du noeud
     */
    public void setTarget(String target) {
        this.target = target;
    }

    /**
     * Ajoute une dépendance au noeud en cours de création
     * 
     * @param identifier le nom d'une des dépendances
     */
    public void addDependency(String identifier) {
        this.dependencies.add(identifier);
    }

    /**
     * Ajoute une ligne de commande aux commandes déjà présentes
     * 
     * @param command une nouvelle ligne de commande à exécuter
     */
    public void addLineOfCommand(String[] command) {
        StringBuilder line = new StringBuilder();
        for (String word : command) {
            line.append(word);
            line.append(' ');
        }
        this.commands.add(line.toString());
    }

    /**
     * Permet de récupérer l'entièreté des dépendances d'un noeud
     * 
     * @param identifier L'identifiant du noeud sur lequel récupérer les dépendances
     * @return un iterateur contenant à minima un élément
     */
    public Iterator<FileNode> getDependencies(String identifier) {
        return this.tree.getDependenciesFor(identifier);
    }

    /**
     * Retourne un Iterator sur la liste des noeuds nécessitant d'être reconstruit
     * 
     * @param identifier le noeud de base
     * @return un itérateur sur les noeuds à traiter
     */
    public Iterator<FileNode> getBuildsNeeded(String identifier) {
        return this.tree.getDependenciesToBuildFor(identifier);
    }

    /**
     * Permet de récupérer les commandes des objectifs nécessitant d'être
     * reconstruits
     * 
     * @param identifier l'identifiant du noeud à utiliser, si null lève une
     *                   exception
     * @return une liste de tableaux de string, chaque tableau de string correspond
     *         à un objectif et chaque élément du tableau une ligne de commande
     */
    public List<String[]> getCommandsOfNeededBuilds(String identifier) {
        if (identifier == null || identifier.isBlank()) {
            throw new IllegalArgumentException();
        }
        List<String[]> sortie = new ArrayList<>();
        Iterator<FileNode> seeker = this.tree.getDependenciesToBuildFor(identifier);
        while (seeker.hasNext()) {
            sortie.add(seeker.next().getCommand());
        }
        return sortie;
    }
}