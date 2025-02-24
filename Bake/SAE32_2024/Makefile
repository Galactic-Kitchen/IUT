SOURCEDIR = ./src/fr/kanoulier/bakefile
BUILDDIR = ./build/
CLASSPATH = ./build/fr/kanoulier/bakefile
DOCDIR = ./javadoc/
MANIFEST = ./manifest.mf
RESSOURCESDIR = ./res
TESTDIRS = $(wildcard tests/*)

all:
	@make jar
	@make run

jar : Bake.jar
	@echo "Archive a jour"

Bake.jar: $(CLASSPATH)/Bake.class
	@jar cfm Bake.jar $(MANIFEST) $(RESSOURCESDIR)/Help.txt -C $(BUILDDIR) .

run: 
	java -jar Bake.jar -d

clean:
	@rm -rf $(BUILDDIR)
	@rm -rf $(DOCDIR)

doc:
	@javadoc -sourcepath ./src -subpackages fr.kanoulier.bakefile -quiet -d $(DOCDIR)

test : Bake.jar
	@for dir in $(TESTDIRS); do \
		cd $$dir ;\
		./run.sh ; \
		cd ../.. ; \
	done

mrproper :
	@rm -f Bake.jar

	

$(CLASSPATH)/Bake.class: $(SOURCEDIR)/Bake.java $(CLASSPATH)/LineReader.class $(CLASSPATH)/commandline/CommandLine.class $(CLASSPATH)/TargetHandler.class $(CLASSPATH)/structure/tree/TreeManager.class $(CLASSPATH)/Parser.class
	javac -d $(BUILDDIR) -implicit:none -sourcepath ./src $(SOURCEDIR)/Bake.java

$(CLASSPATH)/LineReader.class: $(SOURCEDIR)/LineReader.java 
	javac -d $(BUILDDIR) -implicit:none -sourcepath ./src $(SOURCEDIR)/LineReader.java

$(CLASSPATH)/Parser.class: $(SOURCEDIR)/Parser.java $(CLASSPATH)/structure/File.class
	javac -d $(BUILDDIR) -implicit:none -sourcepath ./src $(SOURCEDIR)/Parser.java

$(CLASSPATH)/structure/File.class: $(SOURCEDIR)/structure/File.java
	javac -d $(BUILDDIR) -implicit:none -sourcepath ./src $(SOURCEDIR)/structure/File.java

$(CLASSPATH)/commandline/CommandLine.class: $(SOURCEDIR)/commandline/CommandLine.java $(CLASSPATH)/commandline/Options.class $(CLASSPATH)/structure/File.class
	javac -d $(BUILDDIR) -implicit:none -sourcepath ./src $(SOURCEDIR)/commandline/CommandLine.java

$(CLASSPATH)/commandline/Options.class: $(SOURCEDIR)/commandline/Options.java
	javac -d $(BUILDDIR) -implicit:none -sourcepath ./src $(SOURCEDIR)/commandline/Options.java

$(CLASSPATH)/structure/tree/AbstractNode.class: $(SOURCEDIR)/structure/tree/AbstractNode.java
	javac -d $(BUILDDIR) -implicit:none -sourcepath ./src $(SOURCEDIR)/structure/tree/AbstractNode.java

$(CLASSPATH)/structure/tree/DependencyTree.class: $(SOURCEDIR)/structure/tree/DependencyTree.java $(CLASSPATH)/structure/tree/DependencyNode.class $(CLASSPATH)/structure/tree/AbstractNode.class $(CLASSPATH)/structure/tree/FileNode.class $(CLASSPATH)/structure/tree/TransitNode.class
	javac -d $(BUILDDIR) -implicit:none -sourcepath ./src $(SOURCEDIR)/structure/tree/DependencyTree.java

$(CLASSPATH)/structure/tree/DependencyNode.class: $(SOURCEDIR)/structure/tree/DependencyNode.java $(CLASSPATH)/structure/tree/AbstractNode.class $(CLASSPATH)/structure/tree/FileNode.class $(CLASSPATH)/structure/tree/NodeIterator.class $(CLASSPATH)/structure/tree/TimeNodeIterator.class
	javac -d $(BUILDDIR) -implicit:none -sourcepath ./src $(SOURCEDIR)/structure/tree/DependencyNode.java

$(CLASSPATH)/structure/tree/FileNode.class: $(SOURCEDIR)/structure/tree/FileNode.java $(CLASSPATH)/structure/tree/AbstractNode.class $(CLASSPATH)/structure/FileChecker.class
	javac -d $(BUILDDIR) -implicit:none -sourcepath ./src $(SOURCEDIR)/structure/tree/FileNode.java

$(CLASSPATH)/structure/tree/TreeManager.class: $(SOURCEDIR)/structure/tree/TreeManager.java $(CLASSPATH)/structure/tree/AbstractNode.class $(CLASSPATH)/structure/tree/DependencyTree.class $(CLASSPATH)/structure/tree/DependencyNode.class $(CLASSPATH)/structure/tree/FileNode.class
	javac -d $(BUILDDIR) -implicit:none -sourcepath ./src $(SOURCEDIR)/structure/tree/TreeManager.java

$(CLASSPATH)/structure/tree/TransitNode.class: $(SOURCEDIR)/structure/tree/TransitNode.java $(CLASSPATH)/structure/tree/AbstractNode.class
	javac -d $(BUILDDIR) -implicit:none -sourcepath ./src $<

$(CLASSPATH)/structure/tree/NodeIterator.class: $(SOURCEDIR)/structure/tree/NodeIterator.java
	javac -d $(BUILDDIR) -implicit:none -sourcepath ./src $<

$(CLASSPATH)/structure/tree/TimeNodeIterator.class: $(SOURCEDIR)/structure/tree/TimeNodeIterator.java $(CLASSPATH)/structure/tree/NodeIterator.class
	javac -d $(BUILDDIR) -implicit:none -sourcepath ./src $<

$(CLASSPATH)/structure/FileChecker.class: $(SOURCEDIR)/structure/FileChecker.java
	javac -d $(BUILDDIR) -implicit:none -sourcepath ./src $<

$(CLASSPATH)/TargetHandler.class: $(SOURCEDIR)/TargetHandler.java $(CLASSPATH)/structure/File.class $(CLASSPATH)/structure/tree/TreeManager.class $(CLASSPATH)/BlockCommandExecuter.class
	javac -d $(BUILDDIR) -implicit:none -sourcepath ./src $<

$(CLASSPATH)/BlockCommandExecuter.class: $(SOURCEDIR)/BlockCommandExecuter.java 
	javac -d $(BUILDDIR) -implicit:none -sourcepath ./src $<