CC=gcc
FLAGS_ANSI= -ansi -pedantic
FLAGS_DEPEDENCIES= -lgraph

Snake.exe : master.o graphique.o gestion_jeu.o
	@${CC} ${FLAGS_ANSI} ${FLAGS_DEPEDENCIES} -o $@ $^

%.o : %.c %.h header.h
	${CC} ${FLAGS_ANSI} ${FLAGS_DEPEDENCIES} -c $<

run : Snake.exe
	./Snake.exe

clean :
	rm -f *.o

mrproper :
	rm -f Snake.exe
