# .bash_profile

# Get the aliases and functions
if [ -f ~/.bashrc ]; then
	. ~/.bashrc
fi

# User specific environment and startup programs

PATH=$PATH:/bin
PATH=$PATH:/sbin
PATH=$PATH:/usr/bin
PATH=$PATH:/usr/sbin
PATH=$PATH:/usr/local/bin
PATH=$PATH:/usr/local/sbin
PATH=$PATH:$HOME/bin
PATH=$PATH:/var/www/bin

export PATH
if [ -f ~/.bash_aliases ] ; then source ~/.bash_aliases; fi
if [ -f ~/.bash_git ] ; then source ~/.bash_git; fi
