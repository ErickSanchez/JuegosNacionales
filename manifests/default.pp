class precise32 {
    exec { "apt_update":
        command => "apt-get update",
        path    => "/usr/bin"
    }

    package { "apache2":
        ensure => present,
        require => Exec["apt_update"]
    }

    service { "apache2":
        ensure => running,
        require => Package["apache2"],
    }

    package { "php5":
        ensure => present,
        require => Exec["apt_update"]
    }

    package { "php5-cli":
        ensure => present,
        require => Exec["apt_update"]
    }

    package { "php5-mysql":
       ensure => present,
       require => Exec["apt_update"]
    }

    package { "libapache2-mod-php5":
        ensure => present,
        require => Exec["apt_update"]
    }

    package { "mysql-server":
        ensure => present,
    }

    service { "mysql":
        ensure => running,
        require => Package["mysql-server"],
    }

    exec { "set-mysql-password":
        unless  => "mysql -uroot -proot",
        path    => ["/bin", "/usr/bin"],
        command => "mysqladmin -uroot password root",
        require => Service["mysql"],
    }

    package { "phpmyadmin":
        ensure => present,
    }

    file { '/var/www':
        ensure => link,
        target => "/vagrant",
        notify => Service['apache2'],
        force  => true
    }

    file { '/var/www/phpmyadmin':
        ensure => link,
        target => "/usr/share/phpmyadmin",
        force  => true
    }

    exec { "phpmyadmin777":
        command => "chmod 777 -R /usr/share/phpmyadmin",
        path => ["/bin", "/usr/bin"],
        require => Package["phpmyadmin"],
    }

}
include precise32
