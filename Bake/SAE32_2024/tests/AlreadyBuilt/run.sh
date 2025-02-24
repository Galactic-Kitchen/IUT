#!/bin/bash
testname=$(basename $(pwd))
sources=( Damier.java Rose.java )
status=1
rm -f *.class
for element in ${sources[@]};do
    javac $element -implicit:none
done
modificationtimedamier=$(stat --format='%y' Damier.class)
modificationtimerose=$(stat --format='%y' Rose.class)

java -jar ../../Bake.jar

if [ ! -f "Damier.class" ]||[ "$modificationtimedamier" != "$(stat --format='%y' Damier.class)" ]||[ ! -f "Rose.class" ]||[ "$modificationtimerose" != "$(stat --format='%y' Rose.class)" ]; then
    echo "Test $testname failed"
else
    echo "Test $testname passed"
    status=0
fi
rm -f *.class
return $status