<?php

/* registration.html.twig */
class __TwigTemplate_de9bacb2d258097454a350a8f9367ac7052e3fb3100be94eb69512876523bbc1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("main.html.twig", "registration.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'navbar' => array($this, 'block_navbar'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "main.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        // line 4
        echo "    Registration
";
    }

    // line 6
    public function block_navbar($context, array $blocks = array())
    {
    }

    // line 7
    public function block_content($context, array $blocks = array())
    {
        // line 8
        echo "    ";
        if (($context["errors"] ?? null)) {
            // line 9
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["errors"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 10
                echo "            <span style='color: red'>";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo "</span><br>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 12
            echo "    ";
        }
        // line 13
        echo "    <form class=\"form-horizontal\" enctype=\"multipart/form-data\" action='/registration' method=\"POST\">
        <fieldset>
            <div id=\"legend\">
                <legend class=\"\">Register</legend>
            </div>
            <div class=\"control-group\">
                <!-- E-mail -->
                <label class=\"control-label\" for=\"email\">E-mail</label>
                <div class=\"controls\">
                    <input type=\"text\" id=\"email\" name=\"email\" placeholder=\"\" class=\"input-xlarge\">
                    <p class=\"help-block\">Please provide your E-mail</p>
                </div>
            </div>

            <div class=\"control-group\">
                <!-- Password-->
                <label class=\"control-label\" for=\"password\">Password</label>
                <div class=\"controls\">
                    <input type=\"password\" id=\"password\" name=\"password\" placeholder=\"\" class=\"input-xlarge\">
                    <p class=\"help-block\">Password should be at least 4 characters</p>
                </div>
            </div>

            <div class=\"control-group\">
                <!-- Password -->
                <label class=\"control-label\" for=\"password_confirm\">Password (Confirm)</label>
                <div class=\"controls\">
                    <input type=\"password\" id=\"password_confirm\" name=\"confirmPass\" placeholder=\"\" class=\"input-xlarge\">
                    <p class=\"help-block\">Please confirm password</p>
                </div>
            </div>

            <div class=\"control-group\">
                <label class=\"control-label\" for=\"input-1\">Select File</label>
                <div class=\"controls\">
                    <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"3000000\"/>
                    <input id=\"input-1\" type=\"file\" name=\"file\" class=\"file\">
                </div>
                <p class=\"help-block\">Browse file</p>

            </div>
            <div class=\"control-group\">
                <!-- Button -->
                <div class=\"controls\">
                    <button class=\"btn btn-primary\">Register</button>

                </div>
            </div>
        </fieldset>
    </form>
";
    }

    public function getTemplateName()
    {
        return "registration.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 13,  63 => 12,  54 => 10,  49 => 9,  46 => 8,  43 => 7,  38 => 6,  33 => 4,  30 => 3,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "registration.html.twig", "/home/rustam/PhpstormProjects/php-exam/src/Views/registration.html.twig");
    }
}
