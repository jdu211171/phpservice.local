
---

<details>
<summary>Configuration</summary>

Before you start using Git, set up your environment to match your workflow and operating system. This ensures consistency and prevents common issues related to line endings, merge conflicts, and credential management.

#### **1.1 Set Global Username and Email**

Your name and email are attached to your commits. Setting them globally ensures a consistent identity across all repositories.

```bash
git config --global user.name "Your Name"
git config --global user.email "you@example.com"
```

#### **1.2 Configure Line Endings**

Different operating systems handle line endings differently (Windows uses CRLF, while macOS and GNU/Linux use LF). Configure Git to handle line endings appropriately to avoid unnecessary diffs.

- **Windows**

  ```bash
  git config --global core.autocrlf true
  ```

  This setting converts LF to CRLF when checking out code and CRLF back to LF when committing.

- **macOS and GNU/Linux**

  ```bash
  git config --global core.autocrlf input
  ```

  This setting leaves LF line endings untouched on checkout but converts CRLF to LF on commit.

#### **1.3 Set Default Text Editor**

Choose your preferred text editor for writing commit messages and editing merge conflicts.

- **Windows (Notepad++)**

  ```bash
  git config --global core.editor "'C:/Program Files/Notepad++/notepad++.exe' -multiInst -notabbar -nosession -noPlugin"
  ```

- **macOS (VS Code)**

  ```bash
  git config --global core.editor "code --wait"
  ```

- **GNU/Linux (nano)**

  ```bash
  git config --global core.editor "nano"
  ```

#### **1.4 Enable Colorized Output**

Improve readability of Git command output.

```bash
git config --global color.ui auto
```

#### **1.5 Configure Rebase Behavior**

Choose your default behavior when pulling changes.

- **Use Rebase Instead of Merge**

  ```bash
  git config --global pull.rebase true
  ```

  This keeps your history linear by rebasing your commits on top of the fetched commits.

#### **1.6 Handle Whitespace**

Avoid issues with trailing whitespace in diffs and patches.

```bash
git config --global core.whitespace trailing-space,space-before-tab
```

</details>

---

<details>
<summary>Cloning Repositories</summary>

- **Clone a Remote Repository**

  ```bash
  git clone [repository URL]
  ```

  Copies a remote repository to your local machine.

</details>

---

<details>
<summary>Branch Management</summary>

- **List Local Branches**

  ```bash
  git branch
  ```

  Displays all branches in your local repository.

- **Create a New Branch**

  ```bash
  git branch [branch-name]
  ```

  Creates a new branch from the current branch.

- **Switch to a Branch**

  ```bash
  git checkout [branch-name]
  ```

  Switches your working directory to the specified branch.

- **Create and Switch to a New Branch**

  ```bash
  git checkout -b [branch-name]
  ```

  Creates a new branch and switches to it immediately.

- **Delete a Branch**

  ```bash
  git branch -d [branch-name]
  ```

  Deletes the specified branch locally.

</details>

---

<details>
<summary>Staging and Committing Changes</summary>

- **Check Status of Changes**

  ```bash
  git status
  ```

  Shows modified files and changes ready to be committed.

- **Stage Changes**

  ```bash
  git add [file] # add specific file to staging area
  git add .      # add all changes to staging area
  ```

  Adds specific files or all changes to the staging area.

- **Commit Changes**

  ```bash
  git commit -m "Commit message"
  ```

  Commits staged changes with a descriptive message.

- **Amend Last Commit**

  ```bash
  git commit --amend
  ```

  Modifies the most recent commit with new changes or message. 

- **Unstage Changes**

  ```bash
  git reset [file]
  ```

  Removes the specified file from the staging area.
- **Unstage All Changes**

  ```bash
  git reset
  ```

  Unstages all changes from the staging area.

</details>

---

<details>
<summary>Synchronizing with Remote Repositories</summary>

- **Fetch Changes**

  ```bash
  git fetch
  ```

  Retrieves updates from the remote repository without merging.

- **Pull Changes and Merge**

  ```bash
  git pull
  ```

  Fetches and merges changes from the remote repository into your current branch.

- **Push Local Commits**

  ```bash
  git push                        # push to default remote branch
  git push origin [branch-name]   # push to specific remote branch
  ```

  Uploads your local commits to the remote repository.

</details>

---

<details>
<summary>Merging and Rebasing</summary>

- **Merge a Branch into Current Branch**

  ```bash
  git merge [branch-name] # merge specified branch into current branch
  ```

  Combines changes from the specified branch into the current one.

- **Rebase Current Branch onto Another**

  ```bash
  git rebase [branch-name] # rebase current branch onto specified branch
  ```

  Moves the base of the current branch to the specified branch. This rewrites commit history.
- **Abort a Rebase**

  ```bash
  git rebase --abort
  ```

  Stops the rebase operation and restores the branch to its original state.

</details>

---

<details>
<summary>Resolving Conflicts</summary>

- **Identify Conflicts**

  ```bash
  git status
  ```

  Lists files with merge conflicts.

- **View Differences**

  ```bash
  git diff          # diff files in working directory
  git diff --staged # diff files in staging area
  ```

  Shows line-by-line differences between files.

- **Use Merge Tool**

  ```bash
  git mergetool
  ```

  Launches a visual tool to resolve merge conflicts.

- **Setup Merge Tool**

  ```bash
  git config --global merge.tool [tool]
  ```

  Configures the default merge tool.

</details>

---

<details>
<summary>Stashing Changes</summary>

- **Stash Uncommitted Changes**

  ```bash
  git stash
  ```

  Saves your local modifications temporarily.

- **List Stashed Changes**

  ```bash
  git stash list
  ```

  Displays a list of stashed changes.

- **Apply Stashed Changes**

  ```bash
  git stash apply
  ```

  Reapplies the most recent stash without removing it.

- **Pop Stashed Changes**

  ```bash
  git stash pop
  ```

  Reapplies and removes the most recent stash.


- **Clear Stash**

  ```bash
  git stash clear
  ```

  Removes all stashed entries.

</details>

---

<details>
<summary>Viewing Commit History</summary>

- **Show Commit Logs**

  ```bash
  git log
  ```

  Displays a list of commits with details.

- **Simplified Log View**

  ```bash
  git log --oneline
  ```

  Shows a condensed list of commits.

- **Graphical Log View**

  ```bash
  git log --graph --oneline --all
  ```

  Visualizes the commit history graphically.

</details>

---

<details>
<summary>Resetting and Reverting</summary>

- **Unstage a File**

  ```bash
  git reset [file]
  ```

  Removes the specified file from the staging area.

- **Hard Reset to a Commit**

  ```bash
  git reset --hard [commit]
  ```

  Resets the repository to the specified commit, discarding all changes.

- **Revert a Commit**

  ```bash
  git revert [commit]
  ```

  Creates a new commit that undoes the changes of the specified commit.

</details>

---

<details>
<summary>Remote Repository Management</summary>

- **List Remote Repositories**

  ```bash
  git remote -v
  ```

  Shows all remote connections.

- **Add a Remote Repository**

  ```bash
  git remote add [name] [URL]
  ```

  Connects a remote repository for collaboration.

- **Remove a Remote Repository**

  ```bash
  git remote remove [name]
  ```

  Disconnects a remote repository.

</details>

---

<details>
<summary>Tagging</summary>

- **Create a Tag**

  ```bash
  git tag [tag-name]
  ```

  Marks a specific commit with a tag.

- **Create an Annotated Tag**

  ```bash
  git tag -a [tag-name] -m "Tag message"
  ```

  Creates a tag with a message and metadata.

- **Push Tags to Remote**

  ```bash
  git push origin [tag-name]
  git push origin --tags
  ```

  Shares your tags with the remote repository.

</details>

---

<details>
<summary>Cleaning Up</summary>

- **Remove Untracked Files**

  ```bash
  git clean -f
  ```

  Deletes untracked files from the working directory.

- **Remove Untracked Files and Directories**

  ```bash
  git clean -fd
  ```

  Deletes untracked files and directories.

</details>

---

