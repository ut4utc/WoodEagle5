# ABOUT

Kunena is a native Joomla forum and communications component written in PHP. Kunena enables forums, bulletin board, support forums, discussions and comments for a Jooomla base website.
REQUIREMENTS

#### Kunena 5.x requirements:

Joomla! 2.5: version 2.5.0 or greater (>= 2.5.0 recommended)
Joomla! 3.5.x: version 3.5.0 or greater (>= 3.8.0 recommended)
PHP: version 5.6 or greater (>= 7.1 recommended)
MySQL: version 4.1.19 or greater (>= 5.0 recommended)

My installer will check for minimal version requirements and will abort the install if they are not met.

In addition I recommend the following PHP settings:

max_execution_time     >= 30
memory_limit           >= 16M  (>= 64M recommended) - depends on other Joomla extensions used
safe_mode               = off
upload_max_filesize    >= 2M
GD, DOM, JSON support installed

Kunena requires the following Joomla settings:

* Site template compatible with Mootools 1.2 or better
* Upgraded to latest versions all extensions that claim to integrate with Kunena 5
* No plugins or modules that were developed for previous versions of Kunena

Version-specific information

Please go to http://docs.kunena.org/en/what-is-kunena and select the specific article corresponding to this release.

## EXAMPLES

If you are looking for examples on how Kunena works or can be installed, I recommend you checkout my site at https://proinsurer.com.ua/en/blog-en tag Kunena

I have setup this forum for users and developers to try out various features of Kunena: http://parketdoska.ua/forum

Most of my modules and Kunena extensions are installed at: https://github.com/ut4utc/WoodEagle5

### INSTALLATION

Kunena is installed via the Joomla component/extension installer. You may download my builds/packages from proinsurer.com.ua via: https://proinsurer.com.ua/en/blog-en/joomla/201-free-download-kunena-5-theme-blueeagle5

The Joomla installers allows you to directly install Kunena via package URL or from a local download of yours or unzip & copy files to WoodEagle5 folder in your_site\components\com_kunena\template\ and then go to Admin panel -> Kunena Forum: Templates -> Wood Eagle5 and setup it to default.

As long as the minimum requirements are met, the Kunena install should take only a few moments. I have spent a great amount of time to automate the entire installation process.

Upgrades are performed just like new installs. There is no need to uninstall Kunena to perform an upgrade. I STRONGLY recommend that you perform a backup before and new software install or upgrade. The upgrade procedure is identical to a new install and is performed via the Joomla extension installer. Kunena will detect all prior version of Kunena and will perform the necessary upgrade tasks fully automatic.

### COMMUNITY

Kunena is a community built and maintained project. There is no commercial entity behind Kunena. I provide all my work for free and donate generous amounts of my time into the project.

As such Kunena itself does not offer commercial or paid for support. I provide our community with a support forum and in general you will find what you need on there. You can find the community support forums here: https://proinsurer.com.ua/en/forum

If you are interested in commercial grade support I encourage you send me a mail: ut4utc[at]gmail.com

The Kunena projects thrives on contributions from the community. I dedicated volunteers spend countless hours every week to help the community.

### CONTRIBUTE

    Create an account on proinsurer.com.ua
    Create a topic (unless there already is one)
    Checkout our GIT repository on github
    Read our documentation
    Read our developer wiki
    Send us a pull request

LICENSE

<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">
	<img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/3.0/au/88x31.png" />
</a>
