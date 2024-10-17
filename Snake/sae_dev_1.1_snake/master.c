#include <stdlib.h>
#include "graph.h"

#include "header.h"
#include "graphique.h"
#include "gestion_jeu.h"

int main (void) {
	int sortie=0;
	int score=0;
	unsigned long temps=0;
	unsigned long modifvitesse=0;
	unsigned long decalage=0;
	int allongementserpent=0;
	int x=30, y=20;
	int fin_x=x-9, fin_y=y;
	char direction='d';
	char vieux_direction ='d';
	char tableaudejeu[HAUTEUR_TABLEAU][LARGEUR_TABLEAU]={};
	decalage=Microsecondes();/*Microsecondes() s'initialise avec une valeur égale à posix, donc méthode david goodenough*/
	modifvitesse=Microsecondes();
	Initialisation(tableaudejeu, fin_x, fin_y, direction);
	DessinerScene(temps, score);
	Pause(temps, &decalage); /*Empêche le jeu de se lancer dès le démarrage du programme*/
	while (sortie==0) {
		if (Microsecondes()-decalage>temps+CYCLE) {
			temps=Microsecondes()-decalage;
		}
		if (ToucheEnAttente()==1) {
		int clavier=Touche();
			if (clavier==XK_Escape) {
				sortie=1;
			}
			else if (clavier==XK_space) {
				Pause(temps, &decalage); 
			}
			else if (clavier==XK_Right) {
				if (direction!='g') {
					direction='d';
				}
			}
			else if (clavier==XK_Left) {
				if (direction!='d') {
					direction='g';
				}
			}
			else if (clavier==XK_Up) {
				if (direction!='b') {
					direction='h';
				}
			}
			else if (clavier==XK_Down) {
				if (direction!='h') {
					direction='b';
				}
			}
		}
		if (Microsecondes()>modifvitesse+CYCLE/10) {
			modifvitesse=Microsecondes()+CYCLE/10;
			tableaudejeu[y][x]=direction;
			AffichageSnake(tableaudejeu, x, y);
			if (direction=='h') {
				y--;
			} else if (direction=='b') {
				y++;
			} else if (direction=='d') {
				x++;
			} else if (direction=='g') {
				x--;
			}
			Verif(tableaudejeu, x, y, direction, &sortie, &score, &allongementserpent);
			AffichageTeteSerpent(tableaudejeu, x, y, direction);

			if (allongementserpent==0) {
				DisparitionSnake(tableaudejeu, fin_x, fin_y);
				tableaudejeu[fin_y][fin_x]=0;
				if (vieux_direction=='d') {
					fin_x++;
				} else if (vieux_direction=='g') {
					fin_x--;
				} else if (vieux_direction=='h') {
					fin_y--;
				} else if (vieux_direction=='b') {
					fin_y++;
				}
				vieux_direction=tableaudejeu[fin_y][fin_x];
			}
			else {
				allongementserpent--;
			}
		}
		/*condition echec => passage sortie a 2*/
		DessinerScene(temps, score);
	}
	(sortie==2)?AffichageEchec():AffichageFinPartie();/*Arrête le jeu quand le joueur échoue, le jeu quitte directement si le joueur appuie sur Echap*/
	FermerGraphique();
	return EXIT_SUCCESS;
}
