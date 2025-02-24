package fr.kanoulier.bakefile.structure.tree;

import java.util.Iterator;

/**
 * Extension de {@link NodeIterator} prenant en compte en plus la gestion des
 * dates des buts
 * 
 * @author Maxence Raymond
 * @version 1.5
 * 
 * @see fr.kanoulier.bakefile.structure.tree.NodeIterator
 */
public class TimeNodeIterator extends NodeIterator {
    /**
     * {@inheritDoc}
     */
    public TimeNodeIterator(DependencyNode node) {
        super(node);
    }

    /**
     * {@inheritDoc}
     */
    public TimeNodeIterator(DependencyNode dependencyNode, boolean debugstate) {
        super(dependencyNode, debugstate);
    }

    /**
     * {@inheritDoc}
     * 
     * Implémentation prenant en compte la nécessité de reconstruire les noeuds
     */
    @Override
    protected void recursivecreate(DependencyNode current) {
        if (list.contains(current) || this.inConsideration.contains(current)) {
            return;
        } else if (!current.needsRebuild(this.debug)) {
            this.inConsideration.add(current);
            return;
        }
        this.inConsideration.add(current);
        if (current.hasDependencies()) {
            Iterator<DependencyNode> seeker = current.getDirectDependencies();
            while (seeker.hasNext()) {
                this.recursivecreate(seeker.next());
            }
        }
        if (this.debug) {
            System.out.println("Considering rebuilding : " + current.getFileName());
        }
        list.add(current);
    }
}
