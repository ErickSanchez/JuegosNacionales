
INSERT INTO `sport` (`idsport`, `sportName`, `sportParticipantsLimit`, `sportParticipantsMin`) VALUES
(1, 'FUTBOL', 20, 11),
(2, 'BASQUETBOL', 12, 9),
(3, 'VOLEIBOL', 14, 6),
(4, 'AJEDREZ', 1, 1);

-- Volcado de datos para la tabla `sportcategory`
--

INSERT INTO `sportcategory` (`idsportCategory`, `idsport`, `sportCategoryName`) VALUES
(1, 1, 'VARONIL'),
(2, 1, 'FEMENIL'),
(3, 2, 'VARONIL'),
(4, 2, 'FEMENIL'),
(5, 3, 'VARONIL'),
(6, 3, 'FEMENIL'),
(7, 4, 'ÚNICA');

-- --------------------------------------------------------
INSERT INTO `usertype` (`iduserType`, `userTypeName`) VALUES
(1, 'Coordinador de Equipo\n'),
(2, 'Coordinador Estatal'),
(3, 'Coordinador de Registro Nacional');


INSERT INTO `user` (`username`, `iduserType`, `userPassword`, `userEmail`, `userPhone`) VALUES
('admin', 3, '21232f297a57a5a743894a0e4a801fc3', 'serick_21@live.com.mx', '4431338489'),
('state', 2, '21232f297a57a5a743894a0e4a801fc3', 'state@gmail.com', '4431338489'),
('team', 1, '21232f297a57a5a743894a0e4a801fc3', 'team@gmail.com', '4431338489');

