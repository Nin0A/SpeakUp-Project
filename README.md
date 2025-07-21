# SpeakUp-Project

**SpeakUp-Project** is a real-time communication platform that allows users to send text messages and engage in audio conversations seamlessly. The project includes a backend API and a frontend client, providing a complete solution for building interactive communication systems.

### 👥 Contributors
- **Nino Arcelin**  
- **Nicka Ratovobodo**  
- **Dimitri Walczak Vela-Mena**

---

### 🚀 Starting the Project

To start the project, follow these simple steps:

**Run the deployment script**: Open a terminal and run the deployment script using the following command:

```bash
./deploy.sh
```

**Access the application**: Once the script has been successfully executed, open your web browser and access the application by entering the following URL:

```bash
http://localhost:8080
```

---


### 🛠️ Technologies Used
- **Backend**: PHP, Eloquent, Slim
- **Frontend**: Vue.js, SCSS, HTML5
- **Deployment**: Docker

---

### 🧑‍💻 Git Workflow

To ensure smooth collaboration and efficient development, we follow the Git workflow outlined below:

1. **Main Branches**:
   - `main` (Production): This branch contains stable code that is ready for production deployment. All final releases should come from this branch.
   - `develop` (Development): This branch contains the latest features and is always deployable to a staging environment. All development work is merged here before being released to production.

2. **Feature Branches**:
   - Create a new branch from `develop` for every feature or bugfix you're working on.
   - Naming convention for feature branches:  
     `feature/{short-description}` (e.g., `feature/user-authentication`).

3. **Workflow**:
   - **Start a Feature**:  
     When starting a new feature, create a branch from `develop`:
     ```bash
     git checkout develop
     git checkout -b feature/{short-description}
     ```
   - **Commit Changes**:  
     Follow the Gitmoji commit guidelines (see below) for meaningful commit messages.
     - Example commit:  
       `git commit -m ":sparkles: add user authentication module"`

   - **Push the Branch**:
     ```bash
     git push origin feature/{short-description}
     ```

   - **Open a Pull Request**:  
     Once the feature is complete, open a pull request (PR) to merge into the `develop` branch. Ensure your PR description explains the feature and any major changes.

   - **Review and Merge**:  
     After reviewing, merge the feature branch into `develop`. Avoid merging directly into `main`.

   - **Deploy**:  
     Once features are merged into `develop` and stable, deploy to the staging environment. When it's ready for production, merge `develop` into `main`.

4. **Release Workflow**:
   - When preparing for a release, create a `release` branch from `develop`:
     ```bash
     git checkout develop
     git checkout -b release/{version-number}
     ```
   - Once the release is finalized, merge it into both `main` and `develop`.

5. **Hotfixes**:
   - For critical issues on production, create a hotfix branch from `main`:
     ```bash
     git checkout main
     git checkout -b hotfix/{issue-description}
     ```
   - After fixing, merge the hotfix into both `main` and `develop` (to keep the branches in sync).

---

### 📜 Gitmoji Commit Guidelines

Use **Gitmojis** to provide clear, standardized commit messages. Here's a list of recommended Gitmojis:

- `✨`: Adding new features
- `🐛`: Bug fixes
- `🛠️`: Working on setup or configuration
- `💄`: UI/UX improvements
- `📦`: Updates to dependencies or package versions
- `🎨`: Code style changes
- `🔧`: Minor changes (fix typos, adjust styles, etc.)
- `📖`: Documentation updates
- `🔥`: Removing dead code or files
- `⚡`: Performance improvements
- `🚀`: Deploying to production
- `✅`: Adding tests

Example commit message :
```bash
git commit -m ":sparkles: add real-time messaging feature"
```
