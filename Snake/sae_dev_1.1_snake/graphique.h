#include "header.h"
#ifndef DessinerScene
void DessinerScene(unsigned long temps, int score);

void Pause(unsigned long temps, unsigned long* decalage);

void AffichageTemps(unsigned long temps);

void AffichageScore(int score);

void AffichageInfos(void);

void AffichageEchec(void);

void AffichageFinPartie(void);

void AffichagePomme(int x, int y);

void AffichageObstacle(int x, int y);

void AffichageTeteSerpent(char tableau[HAUTEUR_TABLEAU][LARGEUR_TABLEAU], int x, int y, char direction);

void AffichageSnake(char tableau[HAUTEUR_TABLEAU][LARGEUR_TABLEAU], int x, int y);

void DisparitionSnake(char tableau[HAUTEUR_TABLEAU][LARGEUR_TABLEAU], int x, int y);
#endif
