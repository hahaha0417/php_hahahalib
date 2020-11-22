<?php

/*
// --------------------------------------------------------------------------
composer require ravisorg/exec-parallel
https://github.com/ravisorg/ExecParallel
Licene MIT
// --------------------------------------------------------------------------
// --------------------------------------------------------------------------
*/

/*
MIT License

Copyright (c) 2017 ravisorg

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

namespace hahahalib\Extend\ExecParallel;

// ExecParallel/src/Job.php


class Job extends \ExecParallel\Job
{
    /*
    有Bug，complete前要讀最後一次，Line 48   
    */
    protected function complete() {
		// 結束前要讀最後一次
		$this->readPipes();
		//

		$this->status = 'complete';

		if (is_resource($this->pipes[1])) {
			fclose($this->pipes[1]);
		}
		$this->pipes[1] = null;
		if (is_resource($this->pipes[2])) {
			fclose($this->pipes[2]);
		}
		$this->pipes[2] = null;
		if (is_resource($this->process)) {
			$returnCode = proc_close($this->process);
			if (is_null($this->returnCode)) {
				$this->returnCode = $returnCode;
			}
		}
		$this->process = null;
		if (!$this->completeTime) {
			$this->completeTime = microtime(true);
			$this->runTime = $this->completeTime - $this->startTime;
		}
		if (!$this->_triggeredComplete) {
			$this->trigger('complete',array($this->returnCode));
			$this->_triggeredComplete = true;
		}
	}

}