-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 15, 2024 at 09:47 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flight_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Bio` text NOT NULL,
  `Address` text NOT NULL,
  `Location` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `Logo` blob NOT NULL,
  `Account` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`ID`, `Name`, `Bio`, `Address`, `Location`, `username`, `password`, `email`, `tel`, `Logo`, `Account`) VALUES
(1, 'root1', 'bio here', '', '', '', 'menna2003', 'ff', '0', '', '0'),
(7, 'company', '', '', '', '', '12334', 'mennaahmed.ma54@gmail.com', '111111111', '', '0'),
(8, 'company2', '', 'gh', 'hhb', '', '12345', 'mennaahmed.ma54@gmail.com', '111111111', '', '2147483647'),
(9, 'root', '', '', '', '', 'menna2003', 'mennaahmed.ma54@gmail.com', '2147483647', '', '0'),
(12, 'com', '', '', '', '', 'menna2003', 'mennaahmed.ma54@gmail.com', '2147483647', '', '0'),
(16, 'flightcomp', 'ffffff', '217 street', '4444', '', '$2y$10$Og8sZmyWdAgmnTu2FkkJTeE3R2mLsN6.ClCIZUHPgnCyLgIhRDFl.', 'yahofd@yahoo.com', '11111111111', '', '4VcqfMk/L9p'),
(17, 'newcomp', 'bio', '22222222', 'Cairo', '', '$2y$10$BJCKIfgVX.szq/Siph6iu.uVSeaWYaRkreYH1EAfJRqgNWhCIlpg2', 'newcomp@gmail.com', '0123845', '', '4VcqfMk/L9p');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Completed` tinyint(1) NOT NULL DEFAULT '0',
  `passengers_no` int(11) NOT NULL,
  `RegPassangers` int(11) NOT NULL,
  `PendPassangers` int(11) NOT NULL,
  `fees` float NOT NULL,
  `company_id` int(11) NOT NULL,
  `start_city` varchar(100) NOT NULL,
  `end_city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`ID`, `Name`, `Completed`, `passengers_no`, `RegPassangers`, `PendPassangers`, `fees`, `company_id`, `start_city`, `end_city`) VALUES
(3, 'name', 0, 0, 0, 0, 0, 1, '', ''),
(16, 'F120', 0, 50, 0, 1, 500, 7, 'Cairo', 'Rome');

-- --------------------------------------------------------

--
-- Table structure for table `itinerary`
--

CREATE TABLE `itinerary` (
  `ID` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `itinerary`
--

INSERT INTO `itinerary` (`ID`, `flight_id`, `city`, `start_time`, `end_time`) VALUES
(19, 16, 'Cairo', '2024-04-15 17:07:00', '2024-04-15 21:07:00'),
(20, 16, 'Rome', '2024-04-15 16:10:00', '2024-04-15 21:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `photo` longblob NOT NULL,
  `passport` longblob NOT NULL,
  `Account` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`ID`, `Name`, `email`, `password`, `tel`, `photo`, `passport`, `Account`) VALUES
(1, 'root', 'ff', 'menna2003', '0', '', '', '2147483647'),
(2, 'passenger', 'passenger@email', 'menna2003', '124783', '', '', '0'),
(5, 'pass', 'mennaa', '1223', '111111111', 0xffd8ffe000104a46494600010100000100010000ffdb0084000906071307121210131215131010111810121718150f1310171716131716171518131a1d2820241b271d151721312225292d2e2e2e171f3538353837282d2e37010a0a0a0e0d0e1b10101b3126202530302b2b2d2d2b2f2b372b2d2f2d2d2b352d2d2f2d2d2d362d2b2d2d2f2d2b2d2e2d2b2d2d2d2d2b2d2d2d2d2b2d2d2b352dffc000110800e100e103012200021101031101ffc4001c0001000202030100000000000000000000000507040601020308ffc400431000010302030406050b020407000000000100020304110512210613314107516171819114223272a11523334252628292a2b1c153d263b2d3f0434455739394a3ffc400190101000301010000000000000000000000000102030405ffc4002211010002020300020203000000000000000001020311122131041341511422e1ffda000c03010002110311003f00bc51110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111705c1bc50728b166af643cefdc14356ed7454da7ab7ed7b41f217568accf836345a154f48197d911f948efdaca3a6e906a0fb222fc927f72d2305e7f0af2859c8aa8774875a383603dec7ff007ae63e92ab19ed53c2e1d85edfddc54ff1b2239c2d6455cd374a36fa5a470ed63c3be05a3f753145d2350d4d839ef889e5231d6fccdcc3ccaced8ed5f61689896dc8b1a87108b1019a2959237ad8e6b878d8ac954488888088880888808888088880888808888088880b0abf148e87473bd6e4d1abbcb978ad5b6a36d453974501b91a3a4d08bf30ceb3daabfacc464abbddc6c4dcea6e7b49e6ba31fc7b5fb952d78858189eddb21b86ea7a9b671f179d3c96b15db695151ec5a31d7edbfcdda7c1415251c95a4b63639e40cc4017b0b8173e2479acbf902a7fa0ff0020baab8b153d6736b4b16aaba5abfa491efef7123cb82c7525f2054ff41fe4162d5d14b4561246f8efc3335cdbf75c2da2d5f215edd68a98d648c89b6cd23c305f802e36b9ec585f2d61dff506ff00ebd6ff006290a39fd0db515038d3524f30f7b7458cfd6f62ab763a87e53aea3848bb64a98daeeacb9c17fe905737c8cd6a5b55694ac4c76b4710a534323e224131bb2922f63e6b1d4c56e11555724926e1f792473f80face27f95815787cd45ac9149183a02e63da0f7122cba6b6898f59cc31970e607f100ac8a3a292b896c6c73c8198d85ec2f6b9597f2054ff0041fe414cdabe4c9da17d1431c1ec73a378e0e639cd70f11aa9dc376eb11c1ad98b6b221c9feacc0764835f30e5d3e40a9fe83fc82c4aaa2928ec248df1df8666b9b7eeb858db163bff008b45ad0b3764fa42a3da63ba6bcc353ce196cd909fb8783bc0dfac05b6af9c312c2a3c447ac2cf1ecbdba3c11c0dd6c7b1bd23cfb38f652626f32d33acc86ab52f69ea97ac76f11af11c38f2e0b53bfc35ade257622eb1bc4a039a416b8020820820ea083d4bb2c1611110111101111011110111101693d236d19c3dada488da599b99e4716c7c34ed7588ee07b16eca8ada1ab35f5d5721e533a26fbb19c82df96fe256ff001e916bf6a5e750c34445e9b1606d84fe89864dd753550c1f8636be67fea112d0b67b67a7da173db0867cd3378f73e48e28c02e0d177bc81725c0596d5d27cfbb86820e65b355387fdc9044d3e54e7cd64747506e282aa5e751551403ba18df23be3247e4bcdbc7d99b4da3aaa164e8e6b87b0d82577d98eaa8deff000667b9ee1751f846d2566cd3cc6d91ed6b1c592d3c81ce84d8facc9207680e847270d6c415619175a474a0f0fc4eaac6e5bbb8de7fc46411b24bf6e76bafda99b0fd7ad495b726e3b57571fc932d544088b10dc4510372e61debe49a32e235cafa5b5f982d3cd56b81e093e3af747031ae7471ef5f9a48626860735972f91cd6fb4f68e3cd6c1b4352e8b08c2a9efa3df5554473b6f774c3fa64f3529d1b41b9a4ad988fa5960a669e766e799ff16c5e6b38de4bc6d3e420c747b883bd98a279e4d6555048f3d818d94927b0051d82ed1556cf3fe6657b403ebc44930bfadb2427d520f511f156c602c0fa986fecb64123bdd8fd777c1a55315533b1199efb7af3485d61f69ee26c3c4ab66c518e62224adb6b776de5652e13512b1b963c464a31134ea5ad7c42b0b6fd9ea8f00aadd9fc066da191d1c3933471995e5ef8e26068735b72f71038bda3c558bd36b861f0e1f44cd046247387644d8e9633e50bbcd45746b06e692b6623e9648295a7b06799e3f445e6a3bc978893c844bfa39ae1ec8a791df6595744e7f8377973dc146e1f8dd66cc48e883df1e47659609038c4483ab6481da7c2e3910558a5699d29b81c41edfaec829e394f332369a30ebf6df43dcaf9b0fd7a989456dc9b94152cae8e2a88c658e76670d2492c70716be3cdcece69b1e24169e6ba555336ad8e8de3331c2c47fbe7dab0764d863a0a7b9f6df34a3dd2f0c1faa37a935dd8a795226595ba94f743bb4afc327760d50f2e6653250bcf1ca2e5d15fb8123ab2b870b2b8d7cc9b4750ec31d4d5acfa4a4a864835b5c5ee5bdc4b40f12be9a6b83c02381170bcecd4e179886d59dc39444592c222202222022220222202a231ca6345595719e3bf7bc7baf717b7e0e0af755d74a5809396be3172c6e49c0fb1f55fe17b1ecb752dfe3df8dfb56f1b868684d970d7078b8e0b3309a7f4b9e18cf07cad6bbddcc331f2baf4e6751b60d03a5298babdd0df4a5861a61dec85a5ff00fd1cf53db2f8e5053d053c1255186563e69256ee2692ee91e00399ba7b11b16858f577ca9535151fd79e49bf3c85dfcab0aa7a3ea1a2718a49eacc8cb364caca6c99ec3301775ec0dc782f2b1f39b6ebeb79d6bb2af6d68b0af5e9cc95550dd63cd188699aee4e702e2f758eb96cd06da95a4e0383cdb5752e19bda266a899dab2369377caf3e3c3892401c56eb1ec761b0904fa64b637b17d342d3d848638dbbaca61b2b618c41144c829c1cc6365fd63f6a47baee7badcdc4db9596df4e5c93bbabcab11d34be96648db5aca689a5b15151d3d3460db35b7625d7b6f29bf6dd6c7b3107a261948de73c93d53bc5e206fc203e6bd31dd9ca1c6ea26aa7cb581f3c8e9080ca5cadb9d1a3d6e00580ee59d52e6011471076ea9e0653b3365ce4306ae206972e2e3a75a9c186d17dcc17b469e534fe854d5d39d37745231a79e69cb69db6ffcc4f82aef6028fd3b11a361f65b3b657fb917cebff4b0ab1df1435d4f3d2cc656b66746e2e8846e75a32e39487102c4969fc2bbec46ccd1619591ba2754c92c9781a246c018d128c8f75dae26e185fe69f231ded7deba293110d43a67ac35188988f1a5a786027add937aff00d52b966ec86354149411c12d51865f4896791bb99a417708d8cb39a2da363bfe22b4fdb0c43e55aeab9ef712d4c8e69fbb9ce5fd365b9b360e8610d6cb3556f435bbcc8ca72c0fca0b834975ec0dc6bd4b9f1c5e6dbafab4eb5dbdaaf6ca870c19e13255cc358c3a3dcd287723212e2f701c72802f6b5d68b87d14fb5552ed73492bdd34f2bbd9602ebbe5791c00bf89200d480b7766c6e1b16b7ac92dc8be9a169ec2431e6ddca5a3c94ccdcc3132086f9b23331cc7939ef712e71d799b0e402dfe9cb927fbabcab1e05ad883238ee22898d8a3bdb36568b6636d3313771ed715d51759241102e7101ad1724e8001cd77444446992176ae3358d82959acb5550c8983ac936fddcdf35f4dc6cdd80d1c0000782a4ba25c09db495871591a452d2de3a4045b3c9c1d25ba9baf896fd92aef5e5e7bf3bee1bd63502222c9611110111101111011110170f6878208b822c41d410795972882a9dafd877e16e75452b4be03eb3e2172f8facb4712dece23b470d77069448642c7b1b27a3cc22cee0c6ef5d0b98cbb8e83575efd8af85aaed26c2d3e344c8df989ceb9d8059c7efb381ef163dab7a6798af19f149af7b50b82747b353d440f9a6a4dc3278dd2daa6171c81e0becd1c4d81d16d35939aa92490f191ee90fe27177f2b3f17d95adc1ae5d16fe21f5e2bbb4ed67b43caddaa0e3ab63f9d8f51d174e0faebe4a97dcbdd106a8ba99888880a536765f4795d266636464131873b8318653139ac6979d06aee3d8a2d145abca261313a6ad43d1cccd92332cd49b91237796a989cec99866b006e4dafa05b6d44be90f7bcf17b8bcfe224ff002bcd0e8b3c58631ef4b5adb1146d6e3d4f45ed4ad27a9bebbbe1c3c564e1586e27b516f44a430c4eff008f51ea32c47168e7f84392f9a95f6511599735d5d1d0373c8e0d1cbacf601c49595b29b1b53b7ae6cb335f4d85821c01d26a8e62dd4dfbdc3aae751bc6ca74494d863c54563cd7550d4178b40c3f762d6fc7eb5c7500ac602cb8b2fc89bf51d435ad221e343471e1f1b2189819146d0c635a2cd0070017ba22e75c444404444044440444404444044440444405178aeced2e2ff4d031eefb56cb27e76d9df152888341aee8b29e4b98669a13c85db230781b3bf5284a9e8cab61fa2aa864f7daf8cfc0395b28af17b47928d42949b62315878430c9eec8d1fe62d58726cc62ccff0090bf74b4dfea2bdd15befc9fb47185067673183c30e3e32d28fde55eacd8cc6e7e14d047efcac3fe57395ee8939f27ece30a4e9fa2ec5aabe96b69e06ff86d7c8ef8b5bfba96a2e84607d8d5d6d4d4906e402d8a33d96398dbb8856b22a4ded3eca62221ae605b0b876016305244d78e0f7032cbe123ee4782d8d11552222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222e9bd6df2dc66b5ed717b7720ee8ba6f5b7b5c5fbc5d793aba269b1919702f6ccdbdbaf8f68f341908b1df5d1309064602002417341b1b58f1ed1e6b9f4c8ef6cedbded6ccdbdef6b5bbd07ba2f06d646f7650f6971d00ccdcda5efa781f25ddb335d621c2c786a107a22e9bd69fac35361a8e3d5f05c09dae17cc2c6dadc5b5e083d11746ccd712d0e048e22e2fc2fc1774044440444404444044440444404444044440444404444051789555344fcb3119f2dec43cdc657bb4006ba46ee1d4071b29458f3d0c752e0f7c6d739b6ca4b4122ce0f163ef35a7bc04116e9e88e66d9bea5f30cafd034bef9801c8b1fc7f95e5575b4ad6b640c63e212b592c9a8dde6bc6d7e6235b39ad0751606fdf2e30e8839ceddb333c3838e56dc87e5cc09edcadbf705c370c85ad2cdd3323810e6e56e520868208b58e8c68fc2106bb16374ce69cf4ef6e46e725adb86fcd07c6d26e08718b2711604e5bdd64495d16f1cd75239a7235e4930df33e531061caf3c48e448b1b29d7d0c4f71798985e5bbb2e2c617169d0b6f6be5ec5d198643180043180d69636d1b000d71bb9a34d013a90a277ae931adf68376291b4bb754ae74d1e595dc32b4be67c66ee177120890e56b4f0eb5d198e52804ba22408f3cae635ce89995af765398078d18efaa2c4d8eaa71b8440048374c2d9482f0e68734db50329d034124db85dce3c495e8dc3a1696910c60b1b91a7232ed6d88ca0db41a9d3b523cec9d6fa6bf1e3503248a3dc399bdbb5ad7001f9dae635a07ad92d96627366eb1c74521566958e2d7349731d676564cfbb9cd0ec9ea837396cecbae801e4b3d985c0c194431068160047186d8b8388b5bed341ef017126170cb98ba2612ef6aed69beb7d7c54a187495b4b348d0c24bf56b4e59b21d08d1c465b7cd1035fa86ca6163c7451c6410c6820dc5801addc6fe6f7fe62b21011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111107ffd9, '', '0'),
(10, 'passnger3', 'mennaahmed.ma54@gmail.com', '122', '111111111', '', '', '2147483647'),
(11, 'ee', 'dd', 'menna2003', '0', '', '', '2147483647'),
(13, 's', 'ss@gma', 'menna2003', '222', '', '', '2147483647'),
(15, 'name', 'email@yahoo.com', '$2y$10$cMNLf8MlmoIn/UKAf39fPu3qO4mipkEW8lzhh8VOI84iXDy0W/jy.', '2147483647', '', '', '0'),
(18, 'newnm', 'yahofd@yahoo.com', '$2y$10$v9CqaDJp5eULDYVnsn/v2OkPU5u8qOdHdb4aY/pciezB1hDKZp8r2', '2147483647', '', '', '12345678912'),
(20, '222', 'yahofd@yahoo.com', '$2y$10$zLi2he5eePvXu0OAY/Gi6OdE/wE6E3XTvNrmGBXTXFyHFC3JO/s4K', '2147483647', '', '', '4VcqfMk/L9p'),
(21, 'passen', 'jjjjjjjjj@gmail.com', '$2y$10$M.TMim8t7RQX1yhSioIl7u96.W5XqtD5d1YHryqRNNg74ZLwRVXcS', '0123845', '', '', '4VcqfMk/L9p'),
(23, 'lama', 'lama@gmail.com', '$2y$10$ka7NuYpX11ZzxRGxuaveier0s2RkWX9xaLr7qAS1DOIq1y5XtJFZm', '1111111111', '', '', '4VcqfMk/L9p'),
(25, 'menna', 'menna@gmail.com', '$2y$10$/sJGrTHXUMI/DaeNmRwGGO/bAaoBecn4gQwl4VNGQI59KWaMFJiy.', '12345678', '', '', '4VcqfMk/L9p'),
(26, 'mennahg', 'mennaahmed.ma54@gmail.com', '$2y$10$9msz1mlTKI8M.2zJ/Zthi.ieJSxrkxNpZm3kHOfIbCMfcfhFrHxT.', '0123845', '', '', '4VcqfMk/L9p');

-- --------------------------------------------------------

--
-- Table structure for table `passengerflight`
--

CREATE TABLE `passengerflight` (
  `flight_id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `Registered` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `passengerflight`
--

INSERT INTO `passengerflight` (`flight_id`, `passenger_id`, `Registered`) VALUES
(16, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `itinerary`
--
ALTER TABLE `itinerary`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `passengerflight`
--
ALTER TABLE `passengerflight`
  ADD KEY `flight_id` (`flight_id`),
  ADD KEY `passenger_id` (`passenger_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `itinerary`
--
ALTER TABLE `itinerary`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `itinerary`
--
ALTER TABLE `itinerary`
  ADD CONSTRAINT `itinerary_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `passengerflight`
--
ALTER TABLE `passengerflight`
  ADD CONSTRAINT `passengerflight_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `passengerflight_ibfk_2` FOREIGN KEY (`passenger_id`) REFERENCES `passenger` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
