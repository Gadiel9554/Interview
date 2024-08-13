-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 13-08-2024 a las 08:32:57
-- Versión del servidor: 5.7.39
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `interview`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inter_business`
--

CREATE TABLE `inter_business` (
  `ID` int(11) NOT NULL,
  `FILTER` varchar(150) NOT NULL,
  `NAME` varchar(150) NOT NULL,
  `ADDRESS` varchar(250) DEFAULT NULL,
  `STATUS` enum('Active','Lock') NOT NULL,
  `DATE` bigint(20) NOT NULL,
  `USER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inter_business`
--

INSERT INTO `inter_business` (`ID`, `FILTER`, `NAME`, `ADDRESS`, `STATUS`, `DATE`, `USER`) VALUES
(1, 'empresa1', 'NEZQWi9EaVkrWkgzbkZZcHFRTHFGQT09OjoUTHpiGlwJe16vJ4eozkyQ', 'MnVsTU9LbzVTNEl1cHVPT0lZbXRJZz09Ojo9hW+Z+5hNOtDmoBjcLmWt', 'Active', 1723524130, 1),
(2, 'empresa2', 'cDR0eitOaDZTMUQzMTJGOGZ3NlEvUT09Ojpe+IU1Gi2SyNZ3eLm4atDJ', 'Vmo4dFR6dlBTbW1yTytLOWU2YU9OUT09Ojq7SVV/SD+KityJONdrM2rQ', 'Active', 1723525137, 1),
(3, 'empresa3', 'MGxmcEhMcmwrQ1p4MDducE1mS2Rmdz09Ojp2H5uRTny/EAGq1IQPcLws', 'ajVsNmRScFFLaWI2ZmNraSsram1zUT09Ojr3aR9867fG1R5T4rYfI2/x', 'Active', 1723531578, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inter_users`
--

CREATE TABLE `inter_users` (
  `ID` int(11) NOT NULL,
  `FILTER` varchar(200) NOT NULL,
  `NAME` varchar(250) NOT NULL,
  `MAIL` varchar(200) NOT NULL,
  `ADDRESS` varchar(250) DEFAULT NULL,
  `BUSINESS` int(11) NOT NULL,
  `SALARY` decimal(10,0) NOT NULL,
  `BLOOD` varchar(10) DEFAULT NULL,
  `FEDERAL_ID` varchar(140) DEFAULT NULL,
  `GENDER` enum('Male','Female') DEFAULT NULL,
  `DATE` bigint(20) NOT NULL,
  `USER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inter_users`
--

INSERT INTO `inter_users` (`ID`, `FILTER`, `NAME`, `MAIL`, `ADDRESS`, `BUSINESS`, `SALARY`, `BLOOD`, `FEDERAL_ID`, `GENDER`, `DATE`, `USER`) VALUES
(1, '$6$rounds=5000$interview$zDzWOJqeCdhUINouNz7gPyVDbFZcLTy4pqjf4eF4PCtk.ygeO3KqNgpllMvG4dSth5cdD6CegLjvhNN2Nc.ad/', 'LzBNcHNYdTNudVl3emUyZnpOTGJoMmU4VTd2RUdCT3J1TldCT3F2ZHNYTT06OrKpQciP0e+45crlRL/OWmE=', 'VWNaMGZtWk8xSDRlTFE3NEJzK3pwVmVVeHF0TUNPb2dNeFZkdlROVkdaaz06Om5fUWhq9YIF3YEokt9A8Y8=', '', 2, '130', 'B-', 'NADJ950122', 'Male', 1723528873, 1),
(2, '$6$rounds=5000$interview$HEUCZmth.Jp7YmJEKd7n3D/tmTu2BgElPutgbA/tIH0Km0qUfy3Cms60n032zNM8LfN.OU1RkHL.6TaS0v7nd/', 'ZDVZSHVXZGdmd1BaaG9ObHVpdUtTdz09Ojqf5JWacy6it+258I3PfmZ4', 'a1NOb25iZ3pvREdveEJzLzc4Z0RGa1FUaVpLRDZBR05UaDUxM3NheWhtST06OsNFXyxWFi/XM81EbUSxBi0=', '', 1, '232', 'A+', '', 'Female', 1723535980, 1),
(3, '$6$rounds=5000$interview$4ZJb9j0NVMqeF5kcLylR9YQtd5TwkiVt1Aoj0X6oQPl.1b06cn7QAwo5oPE2KoOE2hDPox6BhxyuV08xWgMGT0', 'V09zN3M1bzNxRkU2SEwxVFIxZVI5dz09Ojr/xTvE54o/pZPQJg+6TCJ7', 'S1RZbXdkblI1MGl2QXZJMlJISnNQQT09OjrUTuw2ynkb4iAfmLvhmHJ4', NULL, 3, '223', NULL, NULL, NULL, 1723536347, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inter_user_info`
--

CREATE TABLE `inter_user_info` (
  `ID` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL COMMENT 'ID del login enlazado a esta cuenta',
  `SERIAL_KEY` varchar(100) NOT NULL,
  `TYPE` enum('Admin') NOT NULL DEFAULT 'Admin',
  `NAME` varchar(200) NOT NULL,
  `LAST` varchar(200) DEFAULT NULL,
  `EMAIL` varchar(250) NOT NULL,
  `BORN` date DEFAULT NULL,
  `GENDER` enum('male','female') DEFAULT NULL,
  `MARITAL` varchar(300) DEFAULT NULL,
  `BLOOD` varchar(5) DEFAULT NULL,
  `TIME_ZONE` varchar(50) DEFAULT NULL,
  `PHONE` varchar(100) DEFAULT NULL,
  `IMG` varchar(100) DEFAULT NULL,
  `PORTRAIT` varchar(150) DEFAULT NULL,
  `LANG` varchar(10) NOT NULL,
  `COUNTRY` varchar(80) DEFAULT NULL,
  `NOTES` varchar(400) DEFAULT NULL,
  `ACTION` enum('None','Fill Information','Logout','Pay') DEFAULT NULL,
  `DATE` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inter_user_info`
--

INSERT INTO `inter_user_info` (`ID`, `ID_USER`, `SERIAL_KEY`, `TYPE`, `NAME`, `LAST`, `EMAIL`, `BORN`, `GENDER`, `MARITAL`, `BLOOD`, `TIME_ZONE`, `PHONE`, `IMG`, `PORTRAIT`, `LANG`, `COUNTRY`, `NOTES`, `ACTION`, `DATE`) VALUES
(1, 1, 'IN-bhz3-es15-fu26', 'Admin', 'dVlTUXdSc1BlL005SEdocGpIWmZWZWNBWGxSNDAzV3hwK1FkaDk0MzZmYz06OtGLBHGx11e/1RoChscOwcY=', NULL, 'bUVJNjF5MGdvb0RDaXNWbEFtdjdQMDFWUHBXSTQ1STIxQ21aaWdDMnlVcz06OkHONU5Xy6CEtelMGPJQXmY=', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, 'None', 1723517677);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inter_user_login`
--

CREATE TABLE `inter_user_login` (
  `ID` int(11) NOT NULL,
  `MAIL` varchar(200) NOT NULL,
  `PASSWORD` varchar(250) DEFAULT NULL,
  `STATUS` enum('Active','Confirm Mail','Locked') NOT NULL,
  `SERIAL_KEY` varchar(20) NOT NULL,
  `LAST_LOGIN` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inter_user_login`
--

INSERT INTO `inter_user_login` (`ID`, `MAIL`, `PASSWORD`, `STATUS`, `SERIAL_KEY`, `LAST_LOGIN`) VALUES
(1, '$6$rounds=5000$interview$Hd0PzgGewkBeuOa455xTrznfKb.SHKvu190Jfkq1l1oE5AOR7fFmF0MdfORDOs5C9WGcSzPaXzzYPdpH0Ganr.', '$2y$10$oJBGGQVgbBm7.AgBrCQVKeOzL2nncIiuMmg3AZhuGHa3l8SNlt7j.', 'Active', 'IN-bhz3-es15-fu26', 1723518657);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_inter_user`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_inter_user` (
`ID` int(11)
,`SERIAL_KEY` varchar(20)
,`LAST_LOGIN` bigint(20)
,`IMG` varchar(100)
,`NAME` varchar(200)
,`LAST` varchar(200)
,`EMAIL` varchar(250)
,`GENDER` enum('male','female')
,`LANG` varchar(10)
,`BLOOD` varchar(5)
,`PHONE` varchar(100)
,`COUNTRY` varchar(80)
,`NOTES` varchar(400)
,`TYPE` enum('Admin')
,`STATUS` enum('Active','Confirm Mail','Locked')
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_inter_users`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_inter_users` (
`ID` int(11)
,`FILTER` varchar(200)
,`NAME` varchar(250)
,`MAIL` varchar(200)
,`ADDRESS` varchar(250)
,`BUSINESS` int(11)
,`SALARY` decimal(10,0)
,`BLOOD` varchar(10)
,`FEDERAL_ID` varchar(140)
,`GENDER` enum('Male','Female')
,`DATE` bigint(20)
,`USER` int(11)
,`B_ID` int(11)
,`B_FILTER` varchar(150)
,`B_NAME` varchar(150)
,`B_ADDRESS` varchar(250)
,`B_STATUS` enum('Active','Lock')
,`B_DATE` bigint(20)
,`B_USER` int(11)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `view_inter_user`
--
DROP TABLE IF EXISTS `view_inter_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_inter_user`  AS SELECT `u`.`ID` AS `ID`, `l`.`SERIAL_KEY` AS `SERIAL_KEY`, `l`.`LAST_LOGIN` AS `LAST_LOGIN`, `u`.`IMG` AS `IMG`, `u`.`NAME` AS `NAME`, `u`.`LAST` AS `LAST`, `u`.`EMAIL` AS `EMAIL`, `u`.`GENDER` AS `GENDER`, `u`.`LANG` AS `LANG`, `u`.`BLOOD` AS `BLOOD`, `u`.`PHONE` AS `PHONE`, `u`.`COUNTRY` AS `COUNTRY`, `u`.`NOTES` AS `NOTES`, `u`.`TYPE` AS `TYPE`, `l`.`STATUS` AS `STATUS` FROM (`inter_user_info` `u` join `inter_user_login` `l` on((`l`.`SERIAL_KEY` = `u`.`SERIAL_KEY`)))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_inter_users`
--
DROP TABLE IF EXISTS `view_inter_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_inter_users`  AS SELECT `u`.`ID` AS `ID`, `u`.`FILTER` AS `FILTER`, `u`.`NAME` AS `NAME`, `u`.`MAIL` AS `MAIL`, `u`.`ADDRESS` AS `ADDRESS`, `u`.`BUSINESS` AS `BUSINESS`, `u`.`SALARY` AS `SALARY`, `u`.`BLOOD` AS `BLOOD`, `u`.`FEDERAL_ID` AS `FEDERAL_ID`, `u`.`GENDER` AS `GENDER`, `u`.`DATE` AS `DATE`, `u`.`USER` AS `USER`, `b`.`ID` AS `B_ID`, `b`.`FILTER` AS `B_FILTER`, `b`.`NAME` AS `B_NAME`, `b`.`ADDRESS` AS `B_ADDRESS`, `b`.`STATUS` AS `B_STATUS`, `b`.`DATE` AS `B_DATE`, `b`.`USER` AS `B_USER` FROM (`inter_users` `u` left join `inter_business` `b` on((`u`.`BUSINESS` = `b`.`ID`)))  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inter_business`
--
ALTER TABLE `inter_business`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `inter_users`
--
ALTER TABLE `inter_users`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `inter_user_info`
--
ALTER TABLE `inter_user_info`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `inter_user_login`
--
ALTER TABLE `inter_user_login`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inter_business`
--
ALTER TABLE `inter_business`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inter_users`
--
ALTER TABLE `inter_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inter_user_info`
--
ALTER TABLE `inter_user_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inter_user_login`
--
ALTER TABLE `inter_user_login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
