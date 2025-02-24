package fr.kanoulier.bakefile.commandline;

import fr.kanoulier.bakefile.LineReader;

/**
 * Cette classe permet de gérer les options de la ligne de commande.
 * 
 * @author Marco Orfao
 * @version 1.1
 */
public class Options {

    private boolean debug = false;

    /**
     * Constructeur de la classe, il traite les options de la ligne de commande.
     */
    public Options(String option) {
        if (option.equals("--help")) {
            LineReader reader = new LineReader("./res/help.txt");
            while (reader.nextLine() != null) {
                System.out.println(reader.getLine());
            }
            reader.close();
            System.exit(0);
        } else if (option.equals("--version")) {
            System.out.println("\n[Bakefile] Bakefile version 1.0\n");
            System.exit(0);
        } else if (option.equals("-d")) {
            this.debug = true;
        } else {
            System.out.println("\n[Bakefile] bake: invalid option '" + option + "'");
            System.out.println("[Bakefile] Try 'bake --help' for more information.\n");
            System.exit(0);
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

}
