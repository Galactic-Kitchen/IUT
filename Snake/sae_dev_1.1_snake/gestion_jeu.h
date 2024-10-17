#include "header.h"

#ifndef Initialisation
int Initialisation(char tableaudejeu[HAUTEUR_TABLEAU][LARGEUR_TABLEAU], int fin_x, int fin_y, char direction);

int AjoutPomme(char tableau[HAUTEUR_TABLEAU][LARGEUR_TABLEAU]);

int AjoutObstacle(char tableau[HAUTEUR_TABLEAU][LARGEUR_TABLEAU]);

int Verif(char tableaudejeu[HAUTEUR_TABLEAU][LARGEUR_TABLEAU], int x, int y, char direction, int * sortie, int * score, int* allongementserpent);
#endif