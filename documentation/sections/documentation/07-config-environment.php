
<h2><a name="config-environment"></a>Configuring an Environment</h2>
<div>
    <p>
        Following the previous example we will edit the <strong>.mage/config/environments/production.yml</strong> file to configure the environment.
        <br />
        Let's see the sections of the configuration file and what we can setup there.
    </p>

    <p>
        <h3>deployment</h3>
        In the <strong>deployment</strong> section we configure how we copy the application.
        <ul>
            <li><strong>user</strong> - is the username used for the ssh connection.</li>
            <li><strong>from</strong> - is the location of the application, usually is the same directory where Magallanes is, but it could be any other path.</li>
            <li><strong>to</strong> - is the remote directory where the application is gonna be copied. If you are working with releases this shouldn’t be the document root.</li>
            <li><strong>excludes</strong> - is a list of files and directories to exclude in the rsync. Magallanes always excludes the <em>.mage</em> and <em>.git</em> directories.</li>
        </ul>
    </p>
    <p>
      Settings that contain only strings, can be overriden using an environment variable with the name <strong>MAGE_DEPLOYMENT_[UPPERCASE VARIABLE_NAME]</strong>. eg. the following command will set <strong>user</strong> to a different value than defined in the YAML file:
    </p>
    <p class="bash">
        MAGE_DEPLOYMENT_USER="otheruser" <span class="command-mage">mage</span> deploy to:production
    </p>

    <p>
        <h3>hosts</h3>
        In the <strong>hosts</strong> section we configure a list of hosts (IPs or hostnames) to where the rsync will run against. You can also specify a port number like in the example above. Also, note that you should be able to do an SSH connection to the host using <a href="https://www.google.com/search?q=ssh+keys+without+passphrase" target="_blank">ssh keys without passphrase</a>, so you won't be requested any password.
    </p>

    <p>
        <h3>tasks</h3>
        In the <strong>tasks</strong> section we configure which tasks to run and when. You can look a complete list of built-in tasks <a href="#builtin-tasks">here</a>.
        <br />
        Each task is executed in the configured order and in a specific part of the deployment, these moments are these:
        <ul>
            <li><strong>pre-deploy</strong> - before deployments begins. Useful for vendor installation and scm update tasks.</li>
            <li><strong>on-deploy</strong> - executed on each host after the code has been copied. Useful for cache warmup, symlinks creations, etc.</li>
            <li><strong>post-release</strong> - executed on each host after the release has been executed.</li>
            <li><strong>post-deploy</strong> - after the deployment is completed. Useful for general tasks like cleanup a cache system.</li>
        </ul>
        You can setup here your own tasks, bultin tasks <u>always</u> starts with a namespace of the task type it belongs (eg: scm, deployment, etc). On the other hand custom tasks don't have a namespace.
    </p>

    <p>
        <h3>releases</h3>
        In the <strong>releases</strong> section we configure how releases will work for this environment. We will look at this configuration in the <a href="#releases">releases</a> section.
    </p>

    <p>
        <h3>locking</h3>
        When you run a deployment an instance with Magallanes, all further deployments (for any other environment in that instance) are locked. This prevents multiple possible problems that you may experience, like different branches being deployed, a mix of vendors, etc. After the deployment is done, the lock is released.
    </p>

    <p>
        But sometimes you want to force locking the deployment to an environment, you can do this with the lock command.
    </p>

    <p class="bash">
        <span class="command-mage">mage</span> lock to:production
    </p>

    <p>
        This will lock all deployments to the <em>production</em> environment until you unlock it with the <em>unlock</em> command.
    </p>

    <p class="bash">
        <span class="command-mage">mage</span> unlock to:production
    </p>
</div>
