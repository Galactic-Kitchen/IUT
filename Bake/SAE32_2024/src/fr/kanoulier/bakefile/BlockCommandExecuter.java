package fr.kanoulier.bakefile;

import java.util.List;

/**
 * Cette classe va permettre d'executer une liste de commandes
 * 
 * @author Marco Orfao
 * @version 1.1
 */
public class BlockCommandExecuter {
    public BlockCommandExecuter(List<String[]> listCommands, boolean debugMode) {
        for (String[] commands : listCommands) {
            for (String command : commands) {
                try {
                    System.out.println("[Bakefile]   " + command);
                    ProcessBuilder pb = new ProcessBuilder(command.trim().split(" "));
                    pb.inheritIO();
                    pb.start().waitFor();
                } catch (Exception e) {
                    System.err.println("\n[Bakefile] Erreur lors de l'execution de la commande");
                    if (debugMode) {
                        e.printStackTrace();
                    }
                }
            }
        }
    }
}