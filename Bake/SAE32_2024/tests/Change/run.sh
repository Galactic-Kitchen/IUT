#!/bin/bash
testname=$(basename $(pwd))
sources=( Damier.java Rose.java )
for element in ${sources[@]};do
    javac $element -implicit:none
    echo "//This is a comment" >> $element;
done
modificationtimedamier=$(stat --format='%y' Damier.class)
modificationtimerose=$(stat --format='%y' Rose.class)

java -jar ../../Bake.jar

if [ ! -f "Damier.class" ]||[ ! "$modificationtimedamier" != "$(stat --format='%y' Damier.class)" ]||[ ! -f "Rose.class" ]||[ ! "$modificationtimerose" != "$(stat --format='%y' Rose.class)" ]; then
    echo "Test $testname failed"
else
    echo "Test $testname passed"
fi
rm -rf *.class