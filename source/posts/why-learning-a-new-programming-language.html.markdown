---
title: Why learning a new programming language
date: 2011-10-08
updated: 2014-11-20
categories: learning programming
---

"Why should you start learning a new programming language" was the questions I asked me in the 2011?  Nowadays we are all too busy to try out new things, to expand our horizon. In the following chapter I will explain you, how I learned programming languages.


## In the beginning there was Turbo Pascal

The first language I learned was Turbo Pascal. Everything (not only the programs) looked like a great "geek nerving god tool". I quite don't understand what I was doing with Turbo Pascal as my computer science teacher told me to make some simple calculation the perimeter for triangular and other geometric object. It was great to declare your variables and then put them into a function and print line the outcome.  Here are some code snippets:


<script async defer src="https://gist.github.com/wikimatze/435584.js"></script>


Turbo Pascal was my first procedural language and later during my studies I learned in a lecture about compiler construction that this language was developed 1970 by Niklaus Wirth (whom I admire for building such easy and effective techniques like the recursive descendant, but thats another tale). If you want to have this retro feeling check out Ubuntu resources (or other things if you want to stay up).


The following images show the **IDE**. It has few options with fancy looking buttons and no options-overload.

<img src="http://farm8.staticflickr.com/7240/7257427894_93694bded3_b.jpg" class="center" alt="Nice blue environment."/>
<div class="caption">Nice blue environment.</div>


<img src="http://farm9.staticflickr.com/8021/7257429850_2711abddc9_b.jpg" class="center" alt="A successful compilation."/>
<div class="caption">A successful compilation.</div>


<img src="http://farm8.staticflickr.com/7235/7257429384_7bc10a9f10_b.jpg" class="center" alt="Syntax highlighting looks like in a old hacker movie."/>
<div class="caption">Syntax highlighting looks like in a old hacker movie.</div>

<img src="http://farm8.staticflickr.com/7225/7257429250_448c1fbef6_b.jpg" class="center" alt="Output in a console."/>
<div class="caption">Output in a console.</div>


In secondary school we had written some programs in Delphi (original it had the name Object Pascal).  The new things was that even the girls had little fun in writing programs in it (*some* nice "Hello Kitty" in with pink color, but they actually love it). We learned how to write functions and to create some appealing graphics. After that I lost my interests in programming because the age of **warhammer** or **video games**.


## Then Java came ...

When I started my studies of computer science I knew I had still no programming experience and during my first year I had to learn Java. It was quite good and quite bad if you ask my. The good things about it was that I had to learn an exhausting new methodologies: OOP, Interfaces, Recursion, Inheritance, Encapsulation, Polymorphism and many other concept. I was lost, I wanted to learn how to write simple programs and no one could tell me, why I have to write this *public static void main (String args[])* to start my program. My fellow students told my that I was an absolute newbie (they were actually right).


Chad Fowler wrote in his book **The Passionate Programmer**: "Always be the worst guy in every band you're in." I actually was it and in now time I made great progresses. But some aspects of Java hit my but: It was so long to express simple things, so much overhead with static, private etc. To what I mean have a look on the following code:


```java
class Socke {

  public String farbe;
  public int gewicht;
  private boolean istTrocken;

  void trockne() {
    istTrocken = true;
  }

  void wasche() {
    istTrocken = false;
  }

  boolean istTrocken() {
    return istTrocken;
  }
}

public class NewClass {
  public static void main(String args[]) {
    Socke stinki = new Socke();
    stinki.farbe = "schwarz";
    stinki.gewicht = 565;
    stinki.trockne();
    System.out.println(stinki.istTrocken());
  }
}
```


Ok, you may say: "It's quite readably" but wait until you have written, about several kilo of LOCs and want to maintain or refactor it. I thought that I could understand my "well" written mail client but well afterwards you know it better.


For another term I looked on C++. It was good to see how pointer (or *references*) are working, how you must allocate your memory (Java has it's ) and generics (or *templates*) for your data structures. C++ is like Java, it's OOP and you can program procedural if you like to. Have a look on some code:


```cpp
/*
* 2.1
* Author: Matthias Guenther
* function: repeated shortening of breaches with a ggT
* use the Euklid-Algo to compute the ggT
*/

#include <iostream>
using namespace std;

int compute_ggT(int a, int b){
  if (b == 0){
    return a;
  } else {
    return compute_ggT(b, a % b);
  }
}

void shortening_breach(){
  int a, b, shortening_factor;
  string q;
  do {
    cout << "Please input the parameters to solve the breach: a/b\n";
    cout << "[Input] Parameter a: ";
    cin >> a;
    cout << "[Input] Parameter b: ";
    cin >> b;
    // look at the ggT
    if (b == 0){
      cout << "This is not allowed";
    } else {
      shortening_factor = compute_ggT(a,b);
      a = a / shortening_factor;
      b = b / shortening_factor;
      cout << "The breach is:" << a << "/" << b << "\n Continue?"
            "\n [Input \"q\" to leave the programm or \"c\" to "
            "continue]";
      cin >> q ;
      cout << "\n ";
      }
    } while (q != "q");
}

int main(){
  shortening_breach();
  return 0;
}
```


## Enlightenment with Ruby

Normally I'm not the guy how runs after every hype but I haven't found my beloved programming language. Why not risk a look. And then there was this 'Whosh' (think DC Comics). You could program in different styles, could design your own languages (called DSL) and this nifty framework Ruby on Rails (RoR) with Test-Driven Development (TDD), Behavior Driven Development (BDD), Continuous Integration (CI) and many more things. These things sound a like a mystery for me, but just get started and see how "easy" you can use it with RoR. It hits my head.


It was a very hard steady learning curve but it was more pleasantly then just go to the candy shop and get what you want for nothing. You have to invest much time. But look for yourself on ruby - it looks like a natural language. Look at a script I wrote to tag MP3:


```ruby
require "mp3info"

# setting the basedirectory
base_directory = "check/"

# run through all directories and get the mp3
Dir["#{base_directory}**/*.mp3"].each do |mp3|
  # get the directory
  arr_directory = mp3.split("/")[0..mp3.split("/").length-2]

  # empty string which will be merged to a string and which is needed for file renaming as a path
  directory_of_album = ""
  arr_directory.each do |part|
    directory_of_album << part + "/"
  end

  directory_of_album = directory_of_album.gsub("//", "/")
  mp3_track = ""

  # open the mp3 to read the id3 infos
  Mp3Info.open(mp3) do |track|
    # delete genre
    track.tag2.TCON = "Game"

    # check, if the track title exists
    if track.tag.title != nil
      # mp3 with an underscore are translated in / so we must catch this
      track_string = track.tag.title.gsub("/", "")
      track.tag.title = track_string
    else
      puts "Please set the track-tag for #{mp3.split("/").last} ... NOT converted"
    end
    # save mp3 tag
    mp3_track = track
  end

  # rename files
  if mp3_track.tag.title != nil
    mp3_newname = "#{Dir.pwd}/#{directory_of_album}#{mp3_track.tag.tracknum} - #{mp3_track.tag.title}.mp3"
    output = mp3_newname.split("/")
    File.rename(mp3, mp3_newname)
    puts "#{output[-1]} ... converted [#{mp3_track.tag.album}]"
  end
end
```


## Automating tasks

I resisted very long to learn the bash, but there were so many tasks over the years which I didn't do because it gives me the heebie-jeebies to do the same thing over and over again. After one weekend studying the open book "The Linux Command Line" by William E. Shotts I caught fire.  For a long time I messed my desktop up with tons of images with ugly names, so I wrote a script to change this.  I have a bunch of images with ugly name, so I wrote a script to change this.  Each command has it's purpose you have to learn its syntax. Here is some sample code:


```bash
#!/bin/bash
z=`ls | wc -l`
z=0

for i in *.jpg; do z=$[$z+1]; mv "$i" ${i##*.jpg}$z\_$1.jpg; echo $i ; done # replace watermark_ (prefix)
```


It's like Lego, you have these and that, plug it together to create something new. For my diploma thesis I create a Rakefile (the modern version of make written completely in ruby):


```ruby
desc "Create a directory for the compiled classes"
task :create_class_directory do
  system 'mkdir -p classes'
end

desc "compile the plugin and put the files in the directory"
task :compile_plugin do
  system 'fsc -d classes Plugin.scala'
end

desc "copy the plugin descriptor"
task :copy_plugin_descriptor do
  system 'cp scalac-plugin.xml classes'
end

desc "create the jar file"
task :create_jar_file do
  system 'cd classes; jar cf ../divbyzero.jar .'
end

desc "create environment"
task :create_environment => [:create_class_directory, :compile_plugin, :copy_plugin_descriptor, :create_jar_file] do
  puts 'done with creating the jar file ...'
end

desc "compile the traits"
task :compile_traits do
  system 'fsc -d classes TraitProgrammingHelper.scala'
  system 'fsc -d classes TraitUpdaterHelper.scala'
  system 'fsc -d classes TraitArithmeticRulesHelper.scala'
  system 'fsc -d classes TraitBasicRulesHelper.scala'
end

desc "create environment with traits"
task :create_environment_complete => [:compile_traits, :create_environment]

desc "run example file"
task :test => [:create_environment_complete] do
  system 'scalac -Xplugin:divbyzero.jar Example.scala'
end
```


## Head Scratching With Scala

I learned this language for my diploma-thesis, otherwise I still wouldn't put a thumb on FP. So far I must say that it was a good decision to learn an functional language. Scala showed me how to use *chained function*, *anonymous functions*, *currying*, *type bounds* and many more constructs. In the beginning my head howls like a steam-tank, there was so much new terrain for me that I need several breaks to get used to it. After many hours of happy cramming I got surprisingly insights in doing OOP better. That was is, what the Pragmatic Programmers were preaching. To get new insight in a technology you have to regard it's counterpart. Don't hesitate to do something you would never do, you gain experience and more confidence in your profession.


Here is some of Scala code:


```scala
class Reference[T] {
  private var contents: T = _
  def set(value: T) { contents = value }
  def get: T = contents
}

object IntegerReference {
  def main(args: Array[String]) {
    val cell = new Reference[Int]
    cell.set(13)
    println("Reference contains the half of " + (cell.get * 2))
  }
}
```


## Conclusion

This was my first essay. I tried to cover the things which whom I'm actually dealing. I presented my wide route from my programming experience so that you can see, how the things evolved for me. I always get my hands dirty and try to roll up my sleeves to get a touch about the newest technology.  I think through adventuring you become each day a little bit better then yesterday.


## Further Reading

- [Andy Hunt](http://andy.pragprog.com/)
- [Behavior Driven Development](http://en.wikipedia.org/wiki/Behavior_driven_development)
- [Capistrano](http://www.capify.org)
- [Chad Fowler](http://chadfowler.com/)
- [Continuous Integration](http://en.wikipedia.org/wiki/Continuous_integration)
- [DC comics](http://www.dccomics.com)
- [DSL](http://en.wikipedia.org/wiki/Domain-specific_language)
- [Dave Thomas](http://pragdave.pragprog.com)
- [Encapsulation](http://en.wikipedia.org/wiki/Encapsulation_%28object-oriented_programming%29)
- [FP](http://en.wikipedia.org/wiki/FP_%28programming_language%29)
- [Hello Kitty](http://www.sanrioeurope.com/)
- [IDE](http://en.wikipedia.org/wiki/Integrated_development_environment)
- [Inheritance](http://en.wikipedia.org/wiki/Inheritance_%28object-oriented_programming%29)
- [Interfaces](http://en.wikipedia.org/wiki/Interface_%28computer_science%29)
- [Java](http://www.java.com/en/)
- [Lego](http://www.lego.com)
- [Niklaus Wirth](http://www.inf.ethz.ch/personal/wirth)
- [OOP](http://en.wikipedia.org/wiki/Object-oriented_programming)
- [Object Pascak](http://en.wikipedia.org/wiki/Object_Pascal)
- [Polymorphism](http://en.wikipedia.org/wiki/Subtype_polymorphism)
- [Pragmatic Programmer](http://pragprog.com/titles/tpp/the-pragmatic-programmer)
- [Recursion](http://en.wikipedia.org/wiki/Recursion#Recursion_in_computer_science)
- [Ruby on Rails](http://rubyonrails.org/screencasts)
- [Scala](http://www.scala-lang.org/)
- [Text-Driven Development](http://en.wikipedia.org/wiki/Test-driven_development)
- [The Linux commandline](http://linuxcommand.org/tlcl.php)
- [The Passionate Programmer](http://www.pragprog.com/titles/cfcar2/the-passionate-programmer )
- [generic](http://en.wikipedia.org/wiki/Generic_programming#Templates_in_C.2B.2B)
- [pointer](http://en.wikipedia.org/wiki/Pointer_%28computing%29)
- [rake](http://rake.rubyforge.org/)
- [recursive descendant](http://en.wikipedia.org/wiki/Recursive_descent_parser)
- [ubuntu](http://www.ubuntu.com)
- [video games](http://en.wikipedia.org/wiki/Video_game)
- [warhammer](http://www.games-workshop.com)

