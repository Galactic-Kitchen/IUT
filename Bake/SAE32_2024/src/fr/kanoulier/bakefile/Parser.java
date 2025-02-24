package fr.kanoulier.bakefile;

import java.util.HashMap;

import fr.kanoulier.bakefile.structure.tree.TreeManager;

/**
 * Cette classe va permettre de traiter une ligne du fichier Bakefile
 * 
 * @author Marco Orfao
 * @version 1.6
 */
public class Parser {

    private String line;

    private String[] command;

    private TreeManager tree;

    private Boolean firstTarget = true;

    private HashMap<String, String> variables;

    private String firstTargetName;

    /**
     * Constructeur de la classe, sert à initialiser les variables ainsi que de
     * créer le dictionnaire des variables du Bakefile
     * 
     * 
     * @param tree
     */
    public Parser(TreeManager tree) {
        this.variables = new HashMap<String, String>();
        this.tree = tree;
    }

    /**
     * Méthode permettant de modifier la ligne à traiter
     * 
     * @param line Ligne à traiter
     */
    public void setLine(String line) {
        this.line = line;
        research();
    }

    /**
     * Méthode permettant de traiter la ligne
     */
    public void research() {

        if (this.line.length() != 0) {
            // redéfinit la ligne en enlevant les commentaires
            if (this.line.contains("#")) {
                if (this.line.charAt(0) == '#') {
                    return;
                } else {
                    this.line = this.line.substring(0, this.line.indexOf("#"));
                }
            }

            // traite les variables
            if (this.line.contains("=")) {
                String[] words = this.line.split("=");
                this.variables.put(words[0].replace(" ", ""), words[1].replace(" ", ""));
            }

            // traite les cibles et les dépendances
            else if (this.line.contains(":")) {
                if (!this.firstTarget) {
                    this.tree.push();
                } else {
                    this.firstTarget = false;
                    this.firstTargetName = this.line.split(":")[0].replace(" ", "");
                }
                String[] words = this.line.split(":");
                this.tree.setTarget(words[0].replace(" ", ""));
                if (words.length >= 2) {
                    String[] dependencies = words[1].split(" ");
                    for (String dependency : dependencies) {
                        dependency = dependency.replace("\t", "");
                        if (dependency.length() != 0) {
                            this.tree.addDependency(dependency);
                        }
                    }
                }
            }

            // traite les commandes
            else {
                int index = 0;
                this.command = this.line.replace("\t", "").split(" ");
                for (String word : this.command) {
                    if (word.length() != 0) {
                        if (word.charAt(0) == '$') {
                            this.command[index] = this.variables.get(word.substring(2, word.length() - 1)).replace("\t",
                                    "");
                        }
                    }
                    index++;
                }
                this.tree.addLineOfCommand(this.command);
            }

        }

    }

    /**
     * Méthode permettant de récupérer le nom de la première cible
     * 
     * @return le nom de la première cible
     */
    public String getFirstTargetName() {
        return this.firstTargetName;
    }
}