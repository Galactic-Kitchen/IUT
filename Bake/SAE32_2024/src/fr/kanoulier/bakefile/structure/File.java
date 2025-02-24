package fr.kanoulier.bakefile.structure;

import java.util.ArrayDeque;
import java.util.Queue;

/**
 * cette classe permet d'expliciter la structure d'une file utilisant les
 * classes Queue et ArrayDeque
 * 
 * @author Marco Orfao
 * @version 2.0
 */
public class File<E> {

    /**
     * Queue<E> est une file de type E
     */
    private Queue<E> file;

    /**
     * constructeur de la classe File
     */
    public File() {
        this.file = new ArrayDeque<E>();
    }

    /**
     * cette méthode permet de savoir si la file est vide
     * 
     * @return true si la file est vide, false sinon
     */
    public boolean isEmpty() {
        return this.file.isEmpty();
    }

    /**
     * cette méthode permet d'ajouter un élément à la file
     * 
     * @param arg l'élément à ajouter
     */
    public void enqueue(E arg) {
        this.file.add(arg);
    }

    /**
     * cette méthode permet de retirer un élément de la file
     * 
     * @return l'élément retiré
     */
    public E dequeue() {
        return this.file.poll();
    }

}
