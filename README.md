# 🌱 EcoBuild

> **Build Your Sustainable City of Tomorrow**

EcoBuild is a browser-based city-building simulation game where you play as mayor and grow a thriving, eco-friendly city. Balance economic growth with green initiatives — every decision impacts your city's future!

![HTML](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

---

## 🎮 Gameplay

Place buildings on a 20×10 city grid across four categories and manage your city's key stats in real time:

| Stat | Description |
|---|---|
| 💰 **Funds** | Earn income from commercial buildings; go bankrupt and lose assets |
| ⚡ **Energy** | Power your city with renewables or drain it with industry |
| 🌿 **Green Score** | Plant parks & forests to level up and unlock advanced tech |
| ☁️ **Pollution** | Let it spike above 100 and buildings start getting abandoned |

### 🏗️ Building Categories

| Category | Buildings |
|---|---|
| ☀️ Energy | Solar Panel, Wind Turbine, Hydro Dam |
| 🌳 Nature | Garden, Big Park, Forest |
| 🏭 Industry | Shop, Factory, Corp Tower |
| ♻️ Tech | Recycler, Air Filter |

Higher **Green Score** and more buildings = higher **City Level**, unlocking advanced structures.

---

## ✨ Features

- 🏙️ **City Grid Builder** — Click to place or demolish buildings on a 20×10 map
- 💾 **Save & Load** — Persist your city state to the server and continue anytime
- 👤 **User Accounts** — Sign up, log in, and manage your profile
- 🏆 **Global Leaderboard** — Compete with other mayors by Green Score & City Level
- ⚙️ **Settings** — Customize audio and graphics preferences
- ⚠️ **Danger Mechanics** — Bankruptcy seizures & pollution decay keep you on your toes
- 🎯 **Level System** — Unlock new building tiers as your city grows

---

## 📁 Project Structure

```
Ecobuild/
├── index.html          # Landing page (Login / Sign Up)
├── home.html           # Main menu (New / Continue game)
├── game.html           # Core gameplay
├── leaderboard.html    # Global rankings
├── profile.html        # Player profile
├── settings.html       # Game settings
├── signup.html         # Registration page
└── php/
    ├── login.php
    ├── logout.php
    ├── signup.php
    ├── check_session.php
    ├── save_game.php
    ├── load_game.php
    ├── check_saved_game.php
    ├── get_leaderboard.php
    ├── get_profile.php
    ├── update_profile.php
    ├── get_settings.php
    ├── save_settings.php
    └── delete_account.php
```

---

## 🚀 Getting Started

### Requirements
- A web server with **PHP** support (e.g. XAMPP, WAMP, LAMP)
- **MySQL** database

### Setup
1. Clone the repository:
   ```bash
   git clone https://github.com/AhmedHassan673/Ecobuild.git
   ```
2. Move the `Ecobuild/` folder into your web server's root directory (e.g. `htdocs/` for XAMPP).
3. Import the database schema (create a MySQL DB and configure credentials in your PHP files).
4. Visit `http://localhost/Ecobuild/` in your browser.
5. Sign up and start building! 🏗️

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Frontend | HTML5, CSS3, Vanilla JavaScript |
| Backend | PHP |
| Database | MySQL |
| Fonts | Google Fonts — Fredoka |

---

## 📸 Pages

| Page | Description |
|---|---|
| `index.html` | Login / Sign Up with animated sky background |
| `home.html` | New game or continue saved city |
| `game.html` | Full city builder with live stats panel |
| `leaderboard.html` | Top mayors ranked globally |
| `profile.html` | View and edit your mayor profile |
| `settings.html` | Audio & graphics preferences |

---

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

---

<p align="center">Made with 🌱 by <a href="https://github.com/AhmedHassan673">Ahmed Hassan</a></p>
