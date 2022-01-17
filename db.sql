CREATE TABLE IF NOT EXISTS `noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) NOT NULL,
  `data` date NOT NULL,
  `texto` text NOT NULL,
  `foto` varchar(150) NOT NULL,
  `foto_thumb` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `noticias` (`id`, `titulo`, `data`, `texto`, `foto`, `foto_thumb`) VALUES
(1, 'Título da Notícia', '2022-01-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sed arcu maximus, sollicitudin elit id, vehicula diam. Maecenas egestas massa neque, sit amet sodales magna dapibus non. Donec efficitur interdum dui at fermentum. Maecenas faucibus, velit in blandit viverra, diam orci feugiat ipsum, eget vestibulum nibh augue non orci. Suspendisse et fringilla ex. Aenean commodo vehicula erat, vitae pellentesque magna. Fusce bibendum posuere lorem, ut vulputate ex iaculis ut. Suspendisse potenti. Suspendisse eleifend urna vitae posuere gravida. Curabitur molestie lorem vitae nunc sodales volutpat. Aliquam erat volutpat.\r\n\r\nAenean efficitur imperdiet volutpat. Fusce tristique convallis arcu, et condimentum metus aliquet molestie. Ut quis nibh placerat, sagittis ligula nec, pretium ipsum. Maecenas ex neque, dictum sit amet urna ac, tincidunt tempus est. In hac habitasse platea dictumst. In hac habitasse platea dictumst. Sed tristique fermentum pulvinar. Morbi egestas, orci sit amet fermentum congue, tortor eros facilisis justo, venenatis hendrerit elit nibh a tortor. Duis in nibh dolor. Nullam a diam vehicula, pulvinar nisl et, aliquam arcu. Sed laoreet dui eget suscipit efficitur. In non euismod augue. Cras ut ipsum laoreet mauris hendrerit volutpat a auctor leo.', '', '');