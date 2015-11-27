<h2><a name="releases"></a>Working with Releases</h2>
<div>
    <p>
        Once you have your releases configured, working with them is really easy. Your application will be deployed to a directory called <strong>releases/{releaseId}</strong>, and a symbolic link called <strong>current</strong> will be created to that directory.
        <br />
        The <strong>{releaseId}</strong> is a timestamp (YMDhms) defined at runtime, but the <strong>releases</strong> and <strong>current</strong> are defined in the environment's configuration.
    </p>

    <div class="yaml">
        <ul>
            <li><span class="parameter">releases:</span>
                <ul>
                    <li><span class="parameter">enabled:</span> <span class="boolean">true</span></li>
                    <li><span class="parameter">max:</span> 5</li>
                    <li><span class="parameter">symlink:</span> current</li>
                    <li><span class="parameter">directory:</span> releases</li>
                </ul>
            </li>
        </ul>
    </div>

    <p>
        The configuration is pretty much straight forward, first of all there is a specific <strong>releases</strong> block:
        <ul>
            <li><strong>enabled</strong> - must be set to true to enable the releases feature (default false).</li>
            <li><strong>max</strong> - indicates how many releases will be saved, this option is useful if you box has little space. Exceeding releases are deleted after the deployment is done, so take that into account when calculating the space needed.</li>
            <li><strong>symlink</strong> - name of the symbolic link.</li>
            <li><strong>directory</strong> - name of the directory where the releases are stored.</li>
        </ul>
    </p>
    <p>
      Settings that contain only strings, can be overriden using an environment variable with the name <strong>MAGE_DEPLOYMENT_[UPPERCASE VARIABLE NAME]</strong>. eg. the following command will set <strong>max</strong> to a different value than defined in the YAML file:
    </p>
    <p class="bash">
        MAGE_RELEASE_MAX="20" <span class="command-mage">mage</span> deploy to:production
    </p>

    <br />

    <p>
        The releases feature has a few commands and options for making deployments more easy.
        <br /><br />
        The <strong>list</strong> command display all available releases for the given environment, indicating the date and time of the deploy, and also which is the current release.
    </p>

    <p class="bash">
        <span class="command-mage">mage</span> releases list to:<span class="command-string">production</span>
    </p>

    <br />

    <p>
        There is also an option for overriding a release, suppose you just made a deployment and forgot to add a very tiny line of code (a javascript call or css rule), doing the deployment again would be a waste of space. In this case the <strong>overrideRelease</strong> option comes handy. When used in the deployment, it will reuse the <strong>ReleaseId</strong> of the one which is set as <strong>current</strong>, therefore overwriting all the files. This option is very simple and powerful, so be very careful when using it.
    </p>

    <p class="bash">
        <span class="command-mage">mage</span> deploy to:<span class="command-string">production</span> --overrideRelease
    </p>

    <p>
        Also it is possible to rollback a release to the previous release or to a specific release with the <strong>rollback</strong> command. More of this command in it's own <a href="#rollback">section</a>.
    </p>
</div>
