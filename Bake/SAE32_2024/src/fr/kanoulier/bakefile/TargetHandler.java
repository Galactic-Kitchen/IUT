package fr.kanoulier.bakefile;

import java.util.Iterator;

import fr.kanoulier.bakefile.structure.File;
import fr.kanoulier.bakefile.structure.tree.TreeManager;
import fr.kanoulier.bakefile.structure.tree.DependencyNode;

/**
 * Classe permettant de traiter les cibles
 * 
 * @author Marco Orfao
 * @version 1.2
 */
public class TargetHandler {

    private boolean phony = false;
    private boolean debugMode;

    private File<String> targetList;
    private TreeManager tree;

    /**
     * Constructeur de la classe, il traite les cibles
     * 
     * @param firstTarget Cible à traiter
     * @param tree        Arbre contenant les cibles
     */
    public TargetHandler(String firstTarget, TreeManager tree, boolean debugMode) {
        this.targetList = new File<String>();
        this.targetList.enqueue(firstTarget);
        this.tree = tree;
        this.debugMode = debugMode;
        handle();
    }

    /**
     * Constructeur de la classe, il traite les cibles
     * 
     * @param targetList Liste des cibles à traiter
     * @param tree       Arbre contenant les cibles
     */
    public TargetHandler(File<String> targetList, TreeManager tree, boolean debugMode) {
        this.targetList = targetList;
        this.tree = tree;
        this.debugMode = debugMode;
        handle();
    }

    /**
     * Méthode permettant de traiter les cibles de la ligne de commande
     */
    public void handle() {
        if (tree.getTree().contains(".PHONY")) {
            phony = true;
        }
        if (phony) {
            Iterator<DependencyNode> phonyIt = tree.getTree().getDirectDependenciesOf(".PHONY");
            while (phonyIt.hasNext()) {
                DependencyNode depNode = phonyIt.next();
                tree.getTree().setPhony(tree.getTree().getNode(depNode.getFileName()).getFileName());
            }
        }
        while (!targetList.isEmpty()) {
            String target = targetList.dequeue();
            if (this.debugMode) {
                System.out.println("\n[Bakefile] Building target: " + target);
            }
            new BlockCommandExecuter(tree.getCommandsOfNeededBuilds(target), debugMode);
        }
    }
}
