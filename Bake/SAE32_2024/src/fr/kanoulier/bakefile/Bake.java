package fr.kanoulier.bakefile;

import fr.kanoulier.bakefile.commandline.CommandLine;
import fr.kanoulier.bakefile.structure.tree.TreeManager;

/**
 * Cette classe va permettre de lancer le programme
 * 
 * @author Marco Orfao
 * @version 1.2
 */
public class Bake {
    public static void main(String[] args) {

        // récupération des arguments
        CommandLine command = new CommandLine(args);

        // création de l'arbre
        TreeManager tree = new TreeManager(command.getDebug());

        // parcours du fichier Bakefile et ajout des cibles à l'arbre
        Parser parser = new Parser(tree);
        LineReader readline = new LineReader("./Bakefile");
        while (readline.nextLine() != null) {
            parser.setLine(readline.getLine());
        }
        readline.close();

        // la dernière cible est ajoutée à l'arbre
        tree.push();

        // traitement des cibles mis en ligne de commande
        if (command.getToUpdateList() != null) {
            new TargetHandler(command.getToUpdateList(), tree, command.getDebug());
        } else {
            new TargetHandler(parser.getFirstTargetName(), tree, command.getDebug());
        }

    }
}