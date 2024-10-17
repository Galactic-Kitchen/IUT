#include <stdlib.h>
#include "graph.h"

#include <time.h>

#include "header.h"

int Initialisation(char tableaudejeu[HAUTEUR_TABLEAU][LARGEUR_TABLEAU], int fin_x, int fin_y, char direction) { /*fonction gérant le démarrage du programme tant en partie graphique que pour le positionnement des objets*/
	short indice;
	InitialiserGraphique();
	CreerFenetre(0,0,1280,720);
	ChoisirEcran(2);
	EffacerEcran(CouleurParNom("blue"));
	ChoisirCouleurDessin(CouleurParNom("black"));
	DessinerRectangle(DECALAGE_L,DECALAGE_H,1020,700);/*Dessin de la zone de jeu à proprement parler*/
	RemplirRectangle(DECALAGE_L,DECALAGE_H,1020,700);
	for(indice=0;indice<NB_POMMES_DEBUT;indice++) {
		AjoutPomme(tableaudejeu);
	}
	for(indice=0;indice<NB_OBSTACLES_DEBUT;indice++) {
		AjoutObstacle(tableaudejeu);
	}
	for(indice=0;indice<10;indice++) {
		tableaudejeu[fin_y][fin_x+indice]=direction;
		AffichageSnake(tableaudejeu, fin_x+indice, fin_y);
	}
	AffichageTeteSerpent(tableaudejeu, fin_x+9, fin_y, 'd');
	return EXIT_SUCCESS;
}

int AjoutPomme(char tableau[HAUTEUR_TABLEAU][LARGEUR_TABLEAU]) { /*fonction gérant l'ajout d'une pomme sur le terrain de jeu et appelant la fonction gérant la partie graphique*/
	int x, y;
	srand(time(NULL));
	do {
		x=rand()%LARGEUR_TABLEAU;
		y=rand()%HAUTEUR_TABLEAU;
	} while (tableau[y][x]!=0);
	tableau[y][x]='p';
	AffichagePomme(x, y);
	return EXIT_SUCCESS;
}

int AjoutObstacle(char tableau[HAUTEUR_TABLEAU][LARGEUR_TABLEAU]) { /*fonction gérant l'ajout d'un obstacle sur le terrain de jeu et appelant la fonction gérant la partie graphique*/
	int x, y;
	srand(time(NULL));
	do {
		x=rand()%LARGEUR_TABLEAU;
		y=rand()%HAUTEUR_TABLEAU;
	} while (tableau[y][x]!=0);
	tableau[y][x]='o';
	AffichageObstacle(x, y);
	return EXIT_SUCCESS;
}

int Verif(char tableaudejeu[HAUTEUR_TABLEAU][LARGEUR_TABLEAU], int x, int y, char direction, int * sortie, int * score, int* allongementserpent) {
	/*fonction gérant l'interaction du serpent avec le terrain et ses conséquences*/
	char position=tableaudejeu[y][x];
	if (position =='p') {
		*score+=1;/*L'utilisation de ++ complique les choses*/
		*allongementserpent+=2;
		AjoutPomme(tableaudejeu);
	} else if (y<0 || x<0 || x>=LARGEUR_TABLEAU || y>HAUTEUR_TABLEAU) {
		*sortie=2; /*vérification que le serpent ne heurte pas les murs*/
	} else if (position=='d' || position=='g' || position=='h' || position=='b' || position=='o') {
		*sortie=2; /*vérification que le serpent ne se mange pas lui-même ou un obstacle*/
	}
	return EXIT_SUCCESS;
}
