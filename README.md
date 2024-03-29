# JoinACM

[![](https://poggit.pmmp.io/shield.state/JoinACM)](https://poggit.pmmp.io/p/JoinACM)

[![](https://poggit.pmmp.io/shield.api/JoinACM)](https://poggit.pmmp.io/p/JoinACM)

A simple JoinUI customizable through the 'config.yml' file, you can edit the form and chat messages, you can also edit the sounds.

![Captura de pantalla 2023-03-14 010240](https://user-images.githubusercontent.com/83558341/224910873-d50048b2-a7cf-42a1-a6c3-c6805c341c55.png)
<a href="https://discord.gg/YyE9XFckqb"><img src="https://img.shields.io/discord/837701868649709568?label=discord&color=7289DA&logo=discord" alt="Discord" /></a>

### 📸 Images
**FormUI**
<img src="https://user-images.githubusercontent.com/83558341/224911130-c648279d-056a-4d8e-84d2-03fe92572c49.png">

**BookUI**
<img src="https://user-images.githubusercontent.com/83558341/224911329-40c3467d-23a8-4ab1-b71c-3e54b5386ade.png">

**Title and Animation**
<img src="https://user-images.githubusercontent.com/83558341/224911885-d9908ac2-96cf-4875-bacb-ab01c1bac8f6.png">

### 💡 Implementations
* [X] Configuration.
* [X] Personalization in config
* [X] Two types of forms (FormUI and BookUI)
* [X] New welcome system
* [X] New welcome system for select people
* [X] Join in a selected world
* [X] Commands.
* [x] Keys in config.yml.

### 💾 Config
```yaml
#      _         _            _      ___   __  __ 
#  _  | |  ___  (_)  _ _     /_\    / __| |  \/  |
#  | || | / _ \ | | | ' \   / _ \  | (__  | |\/| |
#   \__/  \___/ |_| |_||_| /_/ \_\  \___| |_|  |_|
#           by fernanACM

# Here is the page for you to choose the sound you like: 
# https://www.digminecraft.com/lists/sound_list_pe.php
# Remember that the type of music must be of the " ", 

# DO NOT TOUCH!
config-version: "2.0.0" 

# ====(PREFIX)====
Prefix: "&l&f[&6JoinACM&f]&r&8»&r "

# ====(VIP SUPPORT)====
JoinVip:
  Support:
    # Use "true" or "false" To activate/deactivate this option
    enabled: false
  # Add player names
  vip-list:
    - fernanACM9606
    - Steve
    - KEN3701
  # Add messages to the aforementioned users, this applies
  # at the time of joining the game.
  # Use: {PLAYER} => player name
  # Example:
  # Join:
  #   PlayerName:
  #    message: "{PLAYER} just joined, please welcome them."
  #    // sounds: https://www.digminecraft.com/lists/sound_list_pe.php
  #    soundName: "random.totem"
  Join:
    fernanACM9606:
      message: "&f[&c{PLAYER}&f]&b:&e The server owner just joined."
      soundName: "random.totem"
    KEN3701:
      message: "&f[&6{PLAYER}&f]&b:&e You have joined ACM servers."
      soundName: "mob.villager.yes"
  # Add messages to the aforementioned users, this applies
  # at the time of leaving the game.
  # Use: {PLAYER} => player name
  # Example:
  # Quit:
  #   PlayerName:
  #    message: "{PLAYER} the owner is gone."
  #    // sounds: https://www.digminecraft.com/lists/sound_list_pe.php
  #    soundName: "random.totem"
  Quit:
    fernanACM9606:
      message: "&f[&c{PLAYER}&f]&b:&e The server owner just joined."
      soundName: "random.pop2"
    KEN3701:
      message: "&f[&6{PLAYER}&f]&b:&e The admin left :)."
      soundName: "mob.villager.no"
    # Sound on/off settings
  Sound:
    # Use "true" or "false" To activate/deactivate this option
    playerJoin: true
    # Use "true" or "false" To activate/deactivate this option
    playerQuit: true
    # sounds: https://www.digminecraft.com/lists/sound_list_pe.php
    # In case you forgot to put "soundName" in a message
    default-joinSoundName: "mob.villager.yes"
    # sounds: https://www.digminecraft.com/lists/sound_list_pe.php
    # In case you forgot to put "soundName" in a message
    default-quitSoundName: "mob.villager.no"

# ====(PLAYER JOIN)====
PlayerJoin:
  BroadCast:
    # (JOIN)
    # Custom message when joining: 
    # Use "{NAME}" to display player name
    playerJoinMessage: "&8[&a+&8]&a {NAME}"
    # sounds: https://www.digminecraft.com/lists/sound_list_pe.php
    joinSoundName: "mob.irongolem.hit"
    # Use "true" or "false" To activate/deactivate this option
    playerJoin: true
    # Use "true" or "false" To activate/deactivate this option
    joinSound: true
    # {FIRST_TIME}
    # Use "{NAME}" to display player name
    firstTimeBroadCastMessage:
      - "=========================================="
      - "&ePlease welcome {NAME}, he has joined our"
      - "&ecommunity for the first time."
      - "=========================================="
  # (JOIN SETTINGS)
  JoinType:
    # Modes:
    # UI => Send form
    # BOOK => Send book
    formType: "UI"
    # FIRST_TIME => When you first join
    # ALWAYS => Always when you join
    # false => Disabled when joined
    modeForm: "ALWAYS"
    # TOAST => Achievement notification
    # MESSAGE => Message in the chat
    # TIP => Message in TIP
    # POPUP Message in POPUP
    # ACTION_BAR => Message in the action bar
    # false => Disabled when joined
    modeMessage: TOAST
    # Use "true" or "false" To activate/deactivate this option
    modeTitle: true
    # Use "true" or "false" To activate/deactivate this option
    modeAnimation: true
    # Use "true" or "false" To activate/deactivate this option
    firstTime: true
    # (ANIMATION)
    Animation:
      # Modes:
      # [BOOTS, CHAINS, PICKAXE, SHOVEL, SWORD, HEART, SHIELD, 
      # SHIELD_ON_FIRE, MIRROR, BLINDNESS, HUNGER, POISON, 
      # HEART_OF_WITHER, MULTi_HEART, EYE, PILLAGER, EMERALD, 
      # TWISTER, TOTEM, GUARDIAN] and "false" => Disabled option
      animationMode: "EMERALD"
      # sounds: https://www.digminecraft.com/lists/sound_list_pe.php
      soundName: "random.anvil_land"
  # (MESSAGE)
  Messages:
    sendToast:
      title: "&l&aJoin&fACM&r&e v2.0.0"
      subTitle: "&bHe is testing a new version of JoinACM with new stuff!"
    sendMessage:
      - "&ePut something here, this is a welcome message >:C"
      - "&b- JoinACM v2.0.0"
    sendTip:
      - "&bWelcome!"
      - "&6{NAME}"
    sendPopup:
      - "&bYou again, &d{NAME}&b?!"
    sendActionBar:
      - "&l&9JOIN ACM"
    sendTitle:
      titleMessage: "&l&6Welcome"
      subTitleMessage: "&f{NAME}&b, thanks for using JoinACM"

    firstTimeMessage:
      - "&e=================="
      - "&bWow, you seem to be new."
      - "&bWelcome."
      - "&e=================="
# ====(PLAYER QUIT)===
PlayerQuit:
  BroadCast:
    # [QUIT]
    # Custom message when joining: 
    # Use "{NAME}" to display player name
    playerQuitMessage: "&8[&c-&8]&c {NAME}"
    # sounds: https://www.digminecraft.com/lists/sound_list_pe.php
    quitSoundName: "mob.irongolem.walk"
    # Use "true" or "false" To activate/deactivate this option
    playerQuit: true
    # Use "true" or "false" To activate/deactivate this option
    quitSound: true
# ====(SPAWN CUSTOM)====
# Modes: 
# DEFAULT => Upon joining, you will appear in the default world.

# CUSTOM => You will be able to define the world where you want 
# to spawn when you join. Use the command /joinacm setspawn

# false => Disable this option
SpawnMode:
  joinSpawn: "DEFAULT"
  undefined-message: "&cYou have not defined &l&bJoinACM&r&c SpawnCustom. &dUse: /joinacm setspawn"

# ====(JOIN UI)====
JoinUI:
  # Use "true" or "false" To activate/deactivate this option
  sendFormMessage: true
  # Use "true" or "false" To activate/deactivate this option
  modeAnimation: true
  # Title 
  sendTitle:
      titleMessage: "&l&6Welcome"
      subTitleMessage: "&f{NAME}&b, thanks for using JoinACM"
  Sounds:
    # sounds: https://www.digminecraft.com/lists/sound_list_pe.php
    closeForm: "random.pop2"
    clickTheButton: "random.fizz"
  # form
  title: "&l&5JoinACM"
  content:
    - "§eWelcome to the server friend :D"
    - "§eI hope you like it very much"
    - "{LINE}{LINE}&cVersion:&e 2.0.0"
    - "&cReport bug:&e &ehttps://discord.gg/YyE9XFckqb"
    - "&cGithub:&b https://github.com/fernanACM/"
    - "&cAuthor: §ffernanACM"
  # You can add an infinite number with or without commands.
  # Example:
  # JoinUI:
  #   buttons:
  #     ButtonName:
  #       name: "Test"
  #       // http or https
  #       image: "https://i.imgur.com/cVJBKqf.png"
  #       // Use "CONSOLE" or "PLAYER"
  #       target: CONSOLE
  #       command: "give {PLAYER} apple 5"
  #         - 
  buttons:
    JoinACM:
      name: "Click to continue"
      image: "https://i.imgur.com/cVJBKqf.png"
    Apple:
      name: "Receive apple{LINE}click"
      # http or https
      image: "textures/items/apple"
      command: "give {PLAYER} apple 5"
      # Use "CONSOLE" or "PLAYER"
      target: "CONSOLE"

# ====(BOOK UI)====
BookUI:
  # Book info
  title: "&l&cJoinACM"
  author: "&afernanACM"
  # Pages
  pages:
    # Here you can add a great infinity of pages
    # Example:
    # BookUI:
    #   pages:
    #     PaginaName:
    #       // The page number, the first page is equal to "0"
    #       page: 3
    #       content:
    #         - "Your content here"
    JoinACM:
      page: 0
      content:
        - "       &l&9JoinACM   {LINE}{LINE}"
        - "§bWelcome to the server friend :D"
        - "§bI hope you like it very much"
        - "{LINE}{LINE}&cVersion:&a 2.0.0"
        - "&cReport bug:&a https://discord.gg/YyE9XFckqb"
        - "&cGithub:&b https://github.com/fernanACM/"
        - "&cAuthor: §afernanACM"
    Page2:
      page: 1
      content:
        - "Here you can add many more information"
        - "&cReport bug:&a https://discord.gg/YyE9XFckqb"
        - "&cGithub:&b https://github.com/fernanACM/"
        - "&cAuthor: §afernanACM"

# ====(MESSAGES)====
Messages:
  no-permission: "&cYou don't have permissions for this"
  spawn-selected-successfully: "&aWorld custom spawn defined:&b {X}, {Y}, {Z}, world:&a {WORLD_NAME}"
  spawn-successfully-removed: "&aThe old spawn has been successfully removed!"

```
***

### 🕹 Commands
- ```/joinacm``` > Open form to preview the 2 types of FormUI
- ```/joinacm setspawn``` > Define spawn
- ```/joinacm removespawn``` > Remove spawn

### 🔒 Permissions
- Executing the command: ```joinacm.command:```
- Define spawn: ```joinacm.command.setpawn```
- Remove spawn: ```joinacm.command.removespawn```

### 📞 Contact 
| Redes | Tag | Link |
|-------|-------------|------|
| YouTube | fernanACM | [YouTube](https://www.youtube.com/channel/UC-M5iTrCItYQBg5GMuX5ySw) | 
| Discord | fernanACM#5078 | [Discord](https://discord.gg/YyE9XFckqb) |
| GitHub | fernanACM | [GitHub](https://github.com/fernanACM)
| Poggit | fernanACM | [Poggit](https://poggit.pmmp.io/ci/fernanACM)
****

### ✔ Credits
| Authors | Github | Lib |
|---------|--------|-----|
| Vecnavium | [Vecnavium](https://github.com/Vecnavium) | [FormsUI](https://github.com/Vecnavium/FormsUI/tree/master/) |
| CortexPE | [CortexPE](https://github.com/CortexPE) | [Commando](https://github.com/CortexPE/Commando/tree/master/) |
| Muqsit | [Muqsit](https://github.com/Muqsit) | [SimplePacketHandler](https://github.com/Muqsit/SimplePacketHandler) |
| DaPigGuy | [DaPigGuy](https://github.com/DaPigGuy) | [libPiggyUpdateChecker](https://github.com/DaPigGuy/libPiggyUpdateChecker) |
| cooldogedev | [cooldogedev](https://github.com/cooldogedev) | [LibBook](https://github.com/cooldogedev/libBook) | 
****
