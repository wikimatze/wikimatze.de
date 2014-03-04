---
layout: reading
title: Working Effectively with Legacy Code
---

- p 13 qualities of Good Unit Tests:
  - They Run fast
  - They help us localize Problems
- p 18 Legacy Code change algorithm
  1. Identity change points
  2. find Test points
  3. Break dependencies
  4. write tests
  5. make changes and refactor
- p 21 two reasons to Break dependencies: Sensing and separation
- p 31 seam: is a place where you can alter behavior in your program without editing in that place
- p 33: One of the biggest challenges in getting legacy code under test is breaking dependencies
- p 36: enabling point: every seam has an enabling point, a place where you can make the decision to use one behavior
  or another
- p 59: Sprout method when add a feature to a system and it can be formulated completely as new code → write the code
in a new method
   1. Find the place where you need to make the changes
   2. If the change can be formulated as a single sequence of statements in on place in a method,
      write down a call for the new method
      → you can comment it, so that the old code works
   3. Determine what local variables you need from the source method and make then arguments to the
      call
   4. Determine whether the sprouted method will need to return values to source method. If so,
      change the call so that its return value is assigned to a variable
   5. Develop the sprout method using TDD
   6. Remove the comment in the source method to enable the calls
- p 78: lag time = is the amount of time that passes between a change that you make and the moment that you get feedback about the change
- p 87: "Once we have tests in place, we are in a better position to add new features. We also have a solid foundation"
- p 88: "TDD is the mos powerful feature-addition technique"
- p 88: TDD Schema
   - Write a failing test case
   - get it to compile
   - make it pass
   - remove duplication
   - repeat
- p 92: "the trick of just copying the code that we need and modifying it in a new method is pretty powerful in the context of legacy code
- p 93: "We can quickly and brutally add feature to code by copying whole blocks of code, but if we don't remove the duplication afterward, we are just causing trouble and making maintenance burden."
- p 93: "With test in place, we are able to remove duplication easily."
- p 97: "a big problem of extennsively inheritance is if we put the feature into subclasses, we can
only have one of those features at a time."
- p 101: "Rename a class is the most powerful refactoring technique. It changes the way people see
code and lets then notice possibilities that they might not have considered  before."
- p 103: Code gets confusing when we override concrete methods too often."
- p 107: "the best way to see if you will have trouble instantiating a class in test harness is to just try to do it.
- p 108: problem with irritating parameter like DB connection in a constructor of a class will be like hell if you want to get a class under test harness
- p 113: hidden dependency: want's to instantiate a class, constructor looks it and then bang!
- p 138: "In Legacy code, there are often methods of very dubious quality lying around in classes


# This Class is too Big and I don't want it get any Bigger
- p 245: problem with big classes
   1. confusing (50 methods → what change, and how it effect it other methods)
   2. Scheduling (class with 20 responsibilities is pain in the ass)
   3. Pain to test
- p 246: "when we encapsulated too much, the stuff inside rots and festers"
- p 246: "Edit and Pray Programming"
- p 246: "Sprout Class and Sprout Method are key tactics without making things worse"
- p 246: "SRP → Single Responsibility Principle"
  "Every class should have a single responsibility: It should have a single purpose in the system
  and there should only one reason to change it."
- p 249: "Learning to see responsibilities is a key design skill"
- p 249: "Legacy Code offers far more possibilities for the application of design skill than new
feature do"
- p 249: "Heuristics for seeing responsibilities"
   - 1 Group methods
     - look for similar method name
     - write a list of all methods along with their access types (public, private) and try to find
       ones that seems to go together
   - 2 look at hidden methods
      - Pay attention to private and protected methods.
      - If a class has many of them, it often indicates that there is a another class in the class
        dying to get out
   - 3 Look for decisions that can change
   - 4 Look for Internal Relationships
      - look for relationships between instance variables and methods
      - Are certain instance variables used by some methods and not others?
      → remember feature sketches
   - 5 Look for the Primary Responsibility
      - try to describe the responsibility of the class in a single sentence.
- p 266: "Just don't let the bugs dissuade your from other refactoring"
- p 298: Sensing variable
- p 301: coupling count is the number of values that Pass into and out of the method you are extracting


# Dependency breaking techniques

Following refactoring techniques can help you to get tests in place → when you do, you'll be able to
make some invasive changes with more confidence that you aren't breaking anything

- p 312: "Programming is the art of doing one thing at a time"
- p 313: "when you are breaking dependencies, you have to apply extra care for PRESERVE SIGNATURES
- p 329: Adapt Parameter
   1. Create the new interface
     → make it simple and communicative as possible
     → try not to create an interface test will require more than the trivial changes in the method
   2. Create a production implementation for the new interface
   3. Create a fake implementation for the new interface
   4. Write a simple test case, passing the fake to the method
   5. Make the changes you need to in the method to use the new parameter
   6. Do your tests to verify that you are able to test the method using the fake
- p 330: Break Out Method Object
   → idea: move a long method to a new class
   → Objects you create using that new class are called method objects because they embody the code
   of a single object
   1. Create a class that will house the method code
   2. Create a constructor for the class and "Preserve Signatures" to give it an extra copy of the
      arguments by the method
   3. For each argument in the constructor, declare an instance variable and give it exactly the
      same type as the variable
   4. Create an empty execution method on the new class. Often this method is called run()
   5. Copy the body of the old method into the execution method
   6. If needed, use "Extract Interface" to break dependencies on the original class.
- p 339: Encapsulate Global Reference
   → "If several globals always used or are modified near each other, they belong in the same class"
   → "We are trying to do the minimal work to get tests in place"
   1. Identify the global you want to encapsulate
   2. Create a class that you want to reference them from
   3. Copy the globals into the class. If some of them are variables, handle them in the
      initialization in the class
   4. Comment out the original declarations of the globals
   5. Declare a global instance of the new class
   6. Preceade each unsubcribed reference with the name of the global instance of the new class.
      Find old references via compiler or grep.

