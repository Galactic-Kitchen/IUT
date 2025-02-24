import javax.swing.*;
import java.awt.*;

/**
 * Cette classe est une simple coquille pour recevoir la mÃ©thode principale
 *
 * @version 1.1 09 March 2014
 * @author me
 */
public class Damier {

  /**
   * Affiche &laquo;Bonjour !&raquo;
   *
   * @param args la liste des arguments de la ligne de commande (inutilisÃ©e ici)
   */
  public static void main(String[] args) {
    JFrame fenetre = new JFrame();
    fenetre.setSize(720, 500);
    fenetre.setLocation(0, 0);
    fenetre.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
    int taille = Integer.parseInt(args[0]);
    GridLayout gestionnaire = new GridLayout(taille, taille);
    fenetre.setLayout(gestionnaire);

    // un composant pour afficher du texte
    for (int i = 1; i <= ((taille * taille) / 2); i++) {
      JTextArea t = new JTextArea("");
      t.setBackground(Color.CYAN);
      fenetre.add(t);
      JTextArea x = new JTextArea("");
      x.setBackground(Color.WHITE);
      fenetre.add(x);
    }
    if ((taille % 2) == 1) {
      JTextArea t = new JTextArea("");
      t.setBackground(Color.CYAN);
      fenetre.add(t);
    }

    // on crée le groupe

    // on configure l'etiquette
    /*
     * etiquette.setHorizontalAlignment(JLabel.RIGHT);
     * etiquette.setVerticalAlignment(JLabel.BOTTOM);
     */

    // on configure le texte

    // on ajoute le composant dans la fenetre, au milieu
    Dimension tailleFenetre = new Dimension(200, 200);

    fenetre.setMinimumSize(tailleFenetre);

    // et on montre le resultat
    fenetre.setVisible(true);
  }
}
//This is a comment
