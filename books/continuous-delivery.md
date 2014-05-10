---
title: Continuous Delivery by Jez Humble and David Farley
---

- p 24: Create a repeatable, reliable, process for releasing software
- p 25: Deploying software involves three things
  1. Provisioning and managing the environment in which your application will run.
  2. Installing the correct version of your application into it.
  3. Configuring your application, including any data or state it requires.
- p 26: If testing is a painful process that occurs before the release, don't do it at the end => do it continually
- p 37: use meaningful commit messages
- p 57: Without continuous integration, your software is broken until somebody proves it works, usually during a testing
  or integration stage.
- p 59: **Checking in regularly brings a lot of benefits:**
  - you changes are smaller and thus less likely to break the build
  - don't get into conflict with code of other people
  - if something catastrophic happens (such as deleting) means you haven't lost to much work
- p 59: CI is impossible, if you have many breaks because your code is not integrated with that of another team
- p 60: **keep the build and process short, if not**:
  - people don't do a full build
  - multiple check-ins -> you don't know which check-in broke the build
  - people check in less often because they have to sit around for ages
- p 66: Don't check in on a broken build
- p 68: Never go home on a broken build (revert the last commit of fix it, because if you get ill or on vacation, the
  other team members will lose a lot of time to fix your code)
- p 69: Always be prepared to revert to previous revisions

