# JoinACM

[![](https://poggit.pmmp.io/shield.state/JoinACM)](https://poggit.pmmp.io/p/JoinACM)
<a href="https://poggit.pmmp.io/p/JoinACM"><img src="https://poggit.pmmp.io/shield.state/JoinACM"></a>

[![](https://poggit.pmmp.io/shield.api/JoinACM)](https://poggit.pmmp.io/p/JoinACM)
<a href="https://poggit.pmmp.io/p/JoinACM"><img src="https://poggit.pmmp.io/shield.api/JoinACM"></a>

A simple JoinUI customizable through the 'config.yml' file, you can edit the form and chat messages, you can also edit the sounds.

![Captura de pantalla 2022-03-31 025848](https://user-images.githubusercontent.com/83558341/161006577-a3c54f12-9745-49d2-b75b-26c4f8a7ca27.png)
<a href="https://discord.gg/YyE9XFckqb"><img src="https://img.shields.io/discord/837701868649709568?label=discord&color=7289DA&logo=discord" alt="Discord" /></a>

**FormJoin All of this can be customized through the data plugin**

### NEWS
* Added option to disable world spawn point.
* New command to display the welcome to make text changes and corrections (/joinacm).
* New message deactivation settings.
* New join message customization.

### Config
```yaml
     #        _         _            _      ___   __  __ 
     #    _  | |  ___  (_)  _ _     /_\    / __| |  \/  |
     #    | || | / _ \ | | | ' \   / _ \  | (__  | |\/| |
     #     \__/  \___/ |_| |_||_| /_/ \_\  \___| |_|  |_|
     #           by fernanACM
     #Here is the page for you to choose the sound you like: https://www.digminecraft.com/lists/sound_list_pe.php
     #Remember that the type of music must be of the " ", 
     #I show you an example.
     #PlaySoundJoin: "random.pop"
     #====================================================================
               #JoinACM Settings - Message Join and Quit
           
     #Respawn at the world spawn point. 
     #Use "true" or "false" To activate/deactivate this option
     Spawn-Teleport: true

     #Custom message when joining: 
     #Use "{PLAYER}" to display player name
     PlayerJoinMessage: "§8[§a+§8]§a {PLAYER}"
     #Disable custom message on join: 
     #Use "true" or "false" To activate/deactivate this option
     PlayerJoin: true
     #Mute sound on join
     JoinSound: true

     #Custom message on exit: 
     #Use "{PLAYER}" to display player name
     PlayerQuitMessage: "§8[§c-§8]§c {PLAYER}"
     #Disable custom message on exit: 
     #Use "true" or "false" To activate/deactivate this option
     PlayerQuit: true
     #Mute sound on exit
     QuitSound: true

     #Message when clicking the JoinACM button: 
     #Use "true" or "false" To activate/deactivate this option
     JoinACM-Message: true
     #Titles when clicking the JoinACM button:
     #Use "true" or "false" To activate/deactivate this option
     Join-Titles: true
     #Mute sound when clicking JoinACM button:
     #Use "true" or "false" To activate/deactivate this option
     ButtonSound: true
     #==========================================================
                        #SOUNDS
     #Sound when it enters the server
     PlaySoundJoin: "mob.irongolem.hit"
     #Sound when you exit the server.
     PlaySoundQuit: "mob.irongolem.walk"
     #JoinACM button sound
     PlaySoundButton: "random.fizz"                                               
     #============================================
                   #TITLES - MESSAGES
     #Message chat: Use '\n' to go down in the text
     Join-Message: "§aWelcome bro :), §ethanks for using JoinACM!"
     #Welcome title
     Join-Title: "§l§6Welcome"
     #welcome subtitle
     Join-SubTitle: "§r§fThanks for using JoinACM"
     #============================================
                  #FORM
     #JoinACM Title
     JoinUI-Title: "§l§5JoinACM"
     #JoinACM Content: Use '\n' to go down in the text
     JoinUI-Content: "§eWelcome to the server friend :D\n§e I hope you like it very much.\n\n\n§bCreated by: §ffernanACM"
     #JoinACm Button
     JoinUI-Button: "Click to continue"
     #============================================

```
***
### Commands
* /joinacm: ```Open menu JoinACM to view your welcome by fernanACM```

### Permission
* Open menu JoinACM: ```joinacm.command```

### Contact
| Redes | Tag | Link |
|-------|-------------|------|
| YouTube | fernanACM | [YouTube](https://www.youtube.com/channel/UC-M5iTrCItYQBg5GMuX5ySw) | 
| Discord | fernanACM#5078 | [Discord](https://discord.gg/YyE9XFckqb) |
| GitHub | fernanACM | [GitHub](https://github.com/fernanACM)
| Poggit | fernanACM | [Poggit](https://poggit.pmmp.io/ci/fernanACM)
****

### Credits
* **[Vecnavium](https://github.com/Vecnavium)**
* **[FormsUI](https://github.com/Vecnavium/FormsUI/tree/master/)** 
