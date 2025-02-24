#!/bin/bash
testname=$(basename $(pwd))
java -jar ./../../Bake.jar

if [ ! -f "Damier.class" ]||[ ! -f "Rose.class" ]; then
    echo "Test $testname failed"
else
    echo "Test $testname passed"
fi
rm -rf *.class
