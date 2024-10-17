#include <stdlib.h>
#include <stdio.h>
#include "graph.h"

#include "header.h"

void AffichageTemps(unsigned long temps) { /*fonction permettrant de transformer le temps en texte à afficher et l'affichant à l'écran*/
	char * texte;
	texte = (char*) malloc(20* sizeof (char));
	temps/=CYCLE;
	snprintf(texte, 20, "Temps : %3ldm%02lds", temps/60, temps%60);
	ChoisirCouleurDessin(CouleurParNom("white"));
	EcrireTexte(2, 40, texte ,1);
	free(texte);
}

void AffichageScore(int score) { /*fonction permettrant de transformer le score en texte à afficher et l'affichant à l'écran*/
	char texte [40];
	snprintf(texte, 40, "Score : %05d", score*5);
	ChoisirCouleurDessin(CouleurParNom("white"));
	EcrireTexte(2,20, texte ,1);
}

void AffichageInfos(void) {
	char ligne1[]= {"Pause : Espace"};
	char ligne2[]= {"Quitter : Echap"};
	char ligne3[]= {"Jaune : Obstacle"};
	char ligne4[]= {"Rouge : Bonus"};
	ChoisirCouleurDessin(CouleurParNom("white"));
	EcrireTexte(2, 60, ligne1, 1);
	EcrireTexte(2, 80, ligne2, 1);
	EcrireTexte(2, 100, ligne3, 1);
	EcrireTexte(2, 120, ligne4, 1);
}

void DessinerScene(unsigned long temps, int score) { /*fonction maitre de dessin, gère les écrans virtuels, les appels aux fonctions pour l'affichage du temps et du score et l'affichage global*/
	CopierZone(2,1,0,0,1280,720,0,0);
	ChoisirEcran(1);
	AffichageTemps(temps);
	AffichageScore(score);
	AffichageInfos();
	ChoisirEcran(2);
	CopierZone(1,0,0,0,1280,720,0,0);
}

void Pause(unsigned long temps, unsigned long* decalage){ /*fonction gérant le menu de pause*/
	ChoisirEcran(0); /*la fonction étant bloquante, cela permet que le texte soit supprimé dès que la pause s'arrête*/
	ChoisirCouleurDessin(CouleurParComposante(252, 116, 3));
	EcrireTexte(DECALAGE_L+10, 30, "PAUSE", 1);
	for(;Touche()!=XK_space;){
	}
	*decalage=Microsecondes()-temps;
	ChoisirEcran(2);
}

void AffichageEchec(void){ /*fonction bloquante gérant le bloquage de l'écran avant de quitter le programme en cas d'échec*/
	ChoisirEcran(0);
	ChoisirCouleurDessin(CouleurParNom("white"));
	EcrireTexte(200, 40, "Ceci est une faillite, votre vie a-t-elle vraiment un sens ?", 2);
	EcrireTexte(200, 200, "Appuyer sur espace pour sortir", 1);
	for (;Touche()!=XK_space;) {       
		/*fonction d'attente*/
	}
}

void AffichageFinPartie(void){ /*fonction bloquante gérant le bloquage de l'écran avant de quitter le programme en cas de départ volontaire*/
	ChoisirEcran(0);
	ChoisirCouleurDessin(CouleurParNom("white"));
	EcrireTexte(200, 40, "Partie finie", 2);
	EcrireTexte(200, 200, "Appuyer sur Echap pour sortir", 1);
	for (;Touche()!=XK_Escape;) {       
		/*fonction d'attente*/
	}
}

void AffichagePomme(int x, int y) { /*partie graphique de la création de pomme*/
	ChoisirCouleurDessin(CouleurParNom("red"));
	RemplirArc(x*SIZE+DECALAGE_L, y*SIZE+DECALAGE_H, SIZE, SIZE, 0, 360);
}

void AffichageObstacle(int x, int y) { /*partie graphique de la création d'obstacle*/
	ChoisirCouleurDessin(CouleurParNom("yellow"));
	RemplirArc(x*SIZE+DECALAGE_L, y*SIZE+DECALAGE_H, SIZE, SIZE, 0, 360);
}

void AffichageTeteSerpent(char tableau[HAUTEUR_TABLEAU][LARGEUR_TABLEAU], int x, int y, char direction) {
	ChoisirCouleurDessin(CouleurParNom("green"));
	RemplirRectangle(x*SIZE+DECALAGE_L, y*SIZE+DECALAGE_H, SIZE, SIZE);
	ChoisirCouleurDessin(CouleurParNom("blue"));
	if (direction=='h') {
		RemplirArc(x*SIZE+DECALAGE_L+2, y*SIZE+DECALAGE_H+2, 4, 4, 0, 360);
		RemplirArc(x*SIZE+DECALAGE_L+11, y*SIZE+DECALAGE_H+2, 4, 4, 0, 360);
	}
	else if (direction=='b') {
		RemplirArc(x*SIZE+DECALAGE_L+2, y*SIZE+DECALAGE_H+11, 4, 4, 0, 360);
		RemplirArc(x*SIZE+DECALAGE_L+11, y*SIZE+DECALAGE_H+11, 4, 4, 0, 360);
	} else if (direction=='d') {
		RemplirArc(x*SIZE+DECALAGE_L+11, y*SIZE+DECALAGE_H+2, 4, 4, 0, 360);
		RemplirArc(x*SIZE+DECALAGE_L+11, y*SIZE+DECALAGE_H+11, 4, 4, 0, 360);
	} else {
		RemplirArc(x*SIZE+DECALAGE_L+2, y*SIZE+DECALAGE_H+2, 4, 4, 0, 360);
		RemplirArc(x*SIZE+DECALAGE_L+2, y*SIZE+DECALAGE_H+11, 4, 4, 0, 360);
	}
}


void AffichageSnake(char tableau[HAUTEUR_TABLEAU][LARGEUR_TABLEAU], int x, int y) { /*fonction permettant d'afficher la partie graphique du snake*/
	ChoisirCouleurDessin(CouleurParNom("green"));
	DessinerRectangle(x*SIZE+DECALAGE_L, y*SIZE+DECALAGE_H, SIZE, SIZE);
	RemplirRectangle(x*SIZE+DECALAGE_L, y*SIZE+DECALAGE_H, SIZE, SIZE);
}

void DisparitionSnake(char tableau[HAUTEUR_TABLEAU][LARGEUR_TABLEAU], int x, int y) { /*fonction permettant d'effacer la partie graphique du snake*/
	ChoisirCouleurDessin(CouleurParNom("black"));
	DessinerRectangle(x*SIZE+DECALAGE_L, y*SIZE+DECALAGE_H, SIZE, SIZE);
	RemplirRectangle(x*SIZE+DECALAGE_L, y*SIZE+DECALAGE_H, SIZE, SIZE);
}
