<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Setup\Test\Unit\Console\Command;

use Magento\Setup\Console\Command\InfoLanguageListCommand;
use Symfony\Component\Console\Tester\CommandTester;

class InfoLanguageListCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $languages = [
            'LNG' => 'Language description'
        ];

        $table = $this->getMock(\Symfony\Component\Console\Helper\Table::class, [], [], '', false);
        $table->expects($this->once())->method('setHeaders')->with(['Language', 'Code']);
        $table->expects($this->once())->method('addRow')->with(['Language description', 'LNG']);

        /** @var \Symfony\Component\Console\Helper\HelperSet|\PHPUnit_Framework_MockObject_MockObject $helperSet */
        $helperSet = $this->getMock(\Symfony\Component\Console\Helper\HelperSet::class, [], [], '', false);
        $helperSet->expects($this->once())->method('get')->with('table')->will($this->returnValue($table));

        /** @var \Magento\Framework\Setup\Lists|\PHPUnit_Framework_MockObject_MockObject $list */
        $list = $this->getMock(\Magento\Framework\Setup\Lists::class, [], [], '', false);
        $list->expects($this->once())->method('getLocaleList')->will($this->returnValue($languages));
        $command = new InfoLanguageListCommand($list);
        $command->setHelperSet($helperSet);
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
    }
}
