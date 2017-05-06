---
title: Github Two-Factor Authentication Failed For HTTPS
date: 2014-03-27
update: 2014-11-20
categories: git learning
---

I heard from [GitHub's Two-Factor Authentication](https://github.com/blog/1614-two-factor-authentication) nearly a couple of days ago when I was reading my RSS feed. I enabled it and couldn't push to any of my repositories anymore. Learn in this blog post how to fix it.


## Two-Factor Authentication

["Is a process involving two stages to verify the identity of an entity trying to access services in a computer or in a network"](http://en.wikipedia.org/wiki/Two-step_verification). Github solves this authentication with sending an SMS to a device which wants to push to their platform.


## Enabling Two-Factor Authentication

1. Open your Account Settings.
2. Set up two-factor authentication.
3. You'll be given the option of setting up 2FA either through a text message, or through an app you can download onto your smart phone.


Once you enter in the number on your GitHub page, your account is verified.


## Setting Up a Personal Access Token

Since you have enabled 2FA, you can create a personal access token.


1. Open your Account Settings.
2. Click on Applications - this is where you can find a section to  create your _Personal Access Token_
3. Save the password in some encrypted file.


## Testing your Personal Access Token

Run:


```bash
$ curl -u <token>:x-oauth-basic https://api.github.com/user
```


If everything works fine then you should get following JSON output:


```json
{
  "login": "wikimatze",
  "id": 264708,
  "avatar_url": "https://avatars.githubusercontent.com/u/264708?",
  "gravatar_id": "9172bb642e29e9959f078f329308faa1",
  "url": "https://api.github.com/users/wikimatze",
  "html_url": "https://github.com/wikimatze",
  "followers_url": "https://api.github.com/users/wikimatze/followers",
  "following_url": "https://api.github.com/users/wikimatze/following{/other_user}",
  "gists_url": "https://api.github.com/users/wikimatze/gists{/gist_id}",
  "starred_url": "https://api.github.com/users/wikimatze/starred{/owner}{/repo}",
  "subscriptions_url": "https://api.github.com/users/wikimatze/subscriptions",
  "organizations_url": "https://api.github.com/users/wikimatze/orgs",
  "repos_url": "https://api.github.com/users/wikimatze/repos",
  "events_url": "https://api.github.com/users/wikimatze/events{/privacy}",
  "received_events_url": "https://api.github.com/users/wikimatze/received_events",
  "type": "User",
  "site_admin": false,
  "name": "Matthias Günther",
  "company": "",
  "blog": "http://wikimatze.de/about.html",
  "location": "Berlin",
  "email": "matthias@wikimatze.de",
  "hireable": true,
  "bio": "software developer, writer, hiker, jogger, and mobile apps lover",
  "public_repos": 64,
  "public_gists": 11,
  "followers": 54,
  "following": 65,
  "created_at": "2010-05-04T16:46:36Z",
  "updated_at": "2014-03-26T04:43:54Z",
  "private_gists": 0,
  "total_private_repos": 0,
  "owned_private_repos": 0,
  "disk_usage": 57682,
  "collaborators": 0,
  "plan": {
    "name": "free",
    "space": 307200,
    "collaborators": 0,
    "private_repos": 0
  }
}
```


If something went wrong, you should get a message like:


```json

{
  "message": "Not Found",
  "documentation_url": "http://developer.github.com/v3"
}
```


## Pushing to a HTTPS Github URL on Your Own

I had all my repositories checked out via HTTPS. But after enabling 2FA, I couldn't push to this repositories anymore.


```bash
$ git remote -v
  origin https://github.com/wikimatze/wikimatze.de.git (fetch)
  origin https://github.com/wikimatze/wikimatze.de.git (push)

$ git push origin master
  fatal: 'git@github.com/wikimatze/wikimatze.de.git' does not appear to be a git repository
  fatal: Could not read from remote repository.

  Please make sure you have the correct access rights
  and the repository exists.
```


I tried every combination of passwords, personal access token and even created a new ssh-key, but it didn't work. I had
to change the remote URL to `git@github.com:wikimatze/wikimatze.de.git` to get it running again.


## Pushing to a HTTPS GitHub URL on an Organization

I'm the maintainer of [vimberlin.de](http://vimberlin.de/) and pushing my changes with the `git@*` remote URL hack did
not work out very well:


```bash
$ git remote -v
  origin git@github.com/vimberlin/vimberlin.de.git (fetch)
  origin git@github.com/vimberlin/vimberlin.de.git (push)

$ git push
  fatal: 'git@github.com/vimberlin/vimberlin.de.git' does not appear to be a git repository
  fatal: Could not read from remote repository.

  Please make sure you have the correct access rights
  and the repository exists.
```


Most posts out there advices to use [osxkeychain](http://olivierlacan.com/posts/why-is-git-https-not-working-on-github/) to save your credentials. Since I'm using [Xubuntu](http://xubuntu.org/) for developing I had to search after another solution.


## Use .netrc File To Store Credentials

The `.netrc` file contains [login and initialization information](http://www.gnu.org/software/inetutils/manual/html\_node/The-_002enetrc-File.html) for managing the auto-login process.


All you have to do is to setup your credentials in `~/.netrc`:


```bash
machine github.com
login wikimatze
password <token>
protocol https

machine gist.github.com
login wikimatze
password <token>
protocol https
```


Where `<token>` is your personal access token. It would be silly to save your password in plain text.


## Encrypt .netrc file with GPG

I assume that you already have your `GPG` key, you need to run the following command:


```bash
$ gpg --encrypt --armor --recipient matthias.guenther@wikimatze.de .netrc
```


And update the credentials helper:


```bash
$ git config --global credential.helper "netrc -f ~/.netrc.asc -v"
```


Now you should be able to push again.


## Update About the organization push problem

[Ryan](https://twitter.com/RyanHiebert) mentioned all you have to do to push to an organization is use a colon before
the username in the URL: Instead of `git@github.com/vimberlin/vimberlin.de.git` it should be `git@github.com:vimberlin/vimberlin.de.git`. This will mark the remote URL as an SSH path.

