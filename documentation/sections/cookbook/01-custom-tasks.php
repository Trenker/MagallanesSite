<h2><a name="cookbook-custom-tasks"></a>Custom Tasks</h2>
<div>
    <p>
    Creating new tasks is a very important part of any good deployment tool. Every project has it's own necessities, so making custom tasks is essential. Luckily this is very easy with Magallanes.
    </p>

    <p>
    The default approach is to store your tasks in the <em>.mage/tasks</em> directory. The Class can have any valid name, and extend the <strong>Mage\Task\AbstractTask</strong> class and be inside the <strong>Task</strong> namespace.
    <br />
    Then you have to implement two methods:
    <ul>
        <li><em>getName</em> - this method returns the name of the task to be displayed while you run Magallanes.</li>
        <li><em>run</em> - this method does the actual work of the task.</li>
    </ul>
    And that's it! Then you can add your task to your environments, just by they class name: <em>Permissions</em> would be <em>permissions</em>, and <em>DumpAssets</em> would be <em>dump-assets</em>.
    </p>

    <p>
    Here is a simple example:
    </p>
    <div class="php">
<span style="color: #c00;">&lt;?php</span><br />

<span style="color: #BA42C7;">namespace</span> Task;<br />
<br />
<span style="color: #BA42C7;">use</span> Mage\Task\AbstractTask;<br />
<br />
<span style="color: #BA42C7;">class</span> Permissions <span style="color: #BA42C7;">extends</span> AbstractTask<br />
{<br />
    <span style="color: #BA42C7; padding-left: 30px;">public function</span> getName()<br />
    <span style="padding-left: 30px;">{</span><br />
        <span style="color: #BA42C7; padding-left: 60px;">return</span> 'Fixing file permissions';<br />
    <span style="padding-left: 30px;">}</span><br />
<br />
    <span style="color: #BA42C7; padding-left: 30px;">public function</span> run()<br />
    <span style="padding-left: 30px;">{</span><br />
        <span style="padding-left: 60px;">$command = <span style="color: #3D81FF;">'chmod 755 . -R'</span>;</span><br />
        <span style="padding-left: 60px;">$result = $this->runCommandRemote($command);</span><br />
<br />
        <span style="color: #BA42C7; padding-left: 60px;">return</span> $result;<br />
    <span style="padding-left: 30px;">}</span><br />
}<br />
    </div>

    <p>
    When specifing a task in your YAML file, the following conversions are taking place:
    <ol>
        <li>lower-case-with-dashs to UpperCamelCase</li>
        <li>The slash is replaced with the namespace separator backslash</li>
        <li>The resulting <em>task ID</em> must translate to one of the following fully qualified class names:
            <ol>
                <li><em>Task\[TASK ID]</em>, <em>do-this</em> will be <em>Task\DoThis</em></li>
                <li><em>[TASK ID]Task</em>, <em>do/this</em> will be <em>Do\ThisTask</em></li>
                <li><em>[TASK ID]</em>, <em>do-this/and-that</em> will be <em>DoThis\AndThat</em></li>
            </ol>
            The first combination, that is autoloaded by the composer autoloader will be used.
        </li>
    </ol>
    The autoloading for the aformentioned directory <em>.mage/tasks</em> and pattern with *Task, this is done by Magellanes itself.
    </p>

    <p>
    Take a look at the <a href="http://api.magephp.com/1.0">API Documentation</a>, the examples tasks, and the ones already built in Magallanes to get some ideas of what kind of custom tasks you can create.
    But basically you can execute any command in your local copy of code and in the remote copy.
    </p>
</div>
