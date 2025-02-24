import javax.swing.*;
import java.awt.*;

/**
 * Cette classe est une simple coquille pour recevoir la mÃ©thode principale
 *
 * @version 1.1 09 March 2014
 * @author me
 */
public class Rose {

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

    // un composant pour afficher du texte
    JLabel Mystral = new JLabel("Aimez-vous les chats ?");
    JLabel Tramontane = new JLabel("Aimez-vous les chats ?");
    JLabel Grec = new JLabel("Aimez-vous les chats ?");
    JLabel Ponant = new JLabel("Aimez-vous les chats ?");
    JLabel Levant = new JLabel("Aimez-vous les chats ?");
    JLabel Libeccio = new JLabel("Aimez-vous les chats ?");
    JLabel Marin = new JLabel("Aimez-vous les chats ?");
    JLabel Sirocco = new JLabel("Aimez-vous les chats ?");

    // on configure l'etiquette
    // question.setHorizontalAlignment(JLabel.CENTER);

    // on crée le groupe
    JPanel haut = new JPanel();
    haut.setLayout(new GridLayout(1, 3));
    haut.add(Mystral);
    haut.add(Tramontane);
    haut.add(Grec);

    JPanel bas = new JPanel();
    bas.setLayout(new GridLayout(1, 3));
    bas.add(Libeccio);
    bas.add(Marin);
    bas.add(Sirocco);

    // on configure le texte

    fenetre.add(haut, BorderLayout.NORTH);
    fenetre.add(Ponant, BorderLayout.WEST);
    fenetre.add(Levant, BorderLayout.EAST);
    fenetre.add(bas, BorderLayout.SOUTH);
    // on ajoute le composant dans la fenetre, au milieu
    Dimension tailleFenetre = new Dimension(200, 200);

    fenetre.setMinimumSize(tailleFenetre);

    // et on montre le resultat
    fenetre.setVisible(true);
  }
}
//This is a comment
