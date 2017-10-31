<?php

/* main.html.twig */
class __TwigTemplate_acddb19b6ee183a745a5c263ddc49de1e93084246dec3e2917a9f13c73ff231a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'navbar' => array($this, 'block_navbar'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    ";
        // line 4
        $this->displayBlock('head', $context, $blocks);
        // line 36
        echo "</head>

<body>
";
        // line 39
        $this->displayBlock('navbar', $context, $blocks);
        // line 69
        echo "<div class=\"container\">
    ";
        // line 70
        $this->displayBlock('content', $context, $blocks);
        // line 107
        echo "</div>

<script src=\"js/bootstrap.min.js\"></script>
</body>
</html>";
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        // line 5
        echo "        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name=\"description\" content=\"\">
        <meta name=\"author\" content=\"\">
        <title>
            ";
        // line 12
        $this->displayBlock('title', $context, $blocks);
        // line 14
        echo "</title>

        <!-- Bootstrap core CSS -->
        ";
        // line 18
        echo "
        ";
        // line 20
        echo "        ";
        // line 21
        echo "        ";
        // line 22
        echo "
        ";
        // line 24
        echo "        ";
        // line 25
        echo "        ";
        // line 26
        echo "        <link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">

        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>
        <script src=\"ckeditor/ckeditor.js\"></script>
        <script src=\"js/comments.js\"></script>

        <!-- Custom styles for this template -->
        <link href=\"css/starter-template.css\" rel=\"stylesheet\">
        <link href=\"css/signin.css\" rel=\"stylesheet\">
    ";
    }

    // line 12
    public function block_title($context, array $blocks = array())
    {
        // line 13
        echo "                Blog
            ";
    }

    // line 39
    public function block_navbar($context, array $blocks = array())
    {
        // line 40
        echo "    <nav class=\"navbar navbar-inverse navbar-fixed-top\">
        <div class=\"container\">
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\" aria-controls=\"navbar\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </button>
                <a class=\"navbar-brand\" href=\"/\">Blog</a>
            </div>
            <div id=\"navbar\" class=\"collapse navbar-collapse\">
                ";
        // line 52
        if (($context["user"] ?? null)) {
            // line 53
            echo "                    <ul class=\"nav navbar-nav\">
                        <li><a href=\"/profile\">My profile</a></li>
                    </ul>
                ";
        }
        // line 57
        echo "                <ul class=\"nav navbar-nav navbar-right\">
                    ";
        // line 58
        if (($context["user"] ?? null)) {
            // line 59
            echo "                        <li class=\"nav-right\"><a href=\"/logout\">Logout</a></li>
                    ";
        } else {
            // line 61
            echo "                        <li class=\"nav-right\"><a href=\"/registration\">Registration</a></li>
                        <li class=\"nav-right\"><a href=\"/login\">Login</a></li>
                    ";
        }
        // line 64
        echo "                </ul>
            </div>
        </div>
    </nav>
";
    }

    // line 70
    public function block_content($context, array $blocks = array())
    {
        // line 71
        echo "        <div class=\"row\">
            ";
        // line 72
        if (($context["posts"] ?? null)) {
            // line 73
            echo "                <div class=\"col-md-12\">
                    <h2 class=\"col-md-10 med\">Posts: ";
            // line 74
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["size"] ?? null), "count", array(), "array"), "html", null, true);
            echo "</h2>
                    <div class=\"col-md-2\">
                        <a href=\"/post/create\" class=\"btn btn-success\" role=\"button\">Create post</a>
                    </div>
                </div>
                ";
            // line 79
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["posts"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
                // line 80
                echo "                    <div class=\"col-md-12\">
                        <div class=\"panel panel-default\">
                            <div class=\"panel-heading\"><a href=\"/post/";
                // line 82
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "post_id", array(), "array"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "title", array(), "array"), "html", null, true);
                echo "</a>
                            </div>
                            <div class=\"panel-body\">
                                <div>
                                    ";
                // line 86
                echo twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "content", array(), "array");
                echo "
                                </div>
                                <p>
                                    <small class=\"text-muted col-md-6\">Added by <a href=\"/user/";
                // line 89
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "user_id", array(), "array"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "email", array(), "array"), "html", null, true);
                echo "</a></small>
                                    <small class=\"text-muted col-md-6 text-right\">Added at ";
                // line 90
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "created_at", array(), "array"), "html", null, true);
                echo "</small>
                                </p>
                            </div>
                        </div>
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 96
            echo "                ";
            $this->loadTemplate("pagination.html.twig", "main.html.twig", 96)->display($context);
            // line 97
            echo "            ";
        } else {
            // line 98
            echo "                <div class=\"col-md-12\">
                    <h2 class=\"col-md-10\">Users have not created any posts yet</h2>
                    <div class=\"col-md-2\">
                        <a href=\"/post/create\" class=\"btn btn-success\" role=\"button\">Create post</a>
                    </div>
                </div>
            ";
        }
        // line 105
        echo "        </div>
    ";
    }

    public function getTemplateName()
    {
        return "main.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  226 => 105,  217 => 98,  214 => 97,  211 => 96,  199 => 90,  193 => 89,  187 => 86,  178 => 82,  174 => 80,  170 => 79,  162 => 74,  159 => 73,  157 => 72,  154 => 71,  151 => 70,  143 => 64,  138 => 61,  134 => 59,  132 => 58,  129 => 57,  123 => 53,  121 => 52,  107 => 40,  104 => 39,  99 => 13,  96 => 12,  83 => 26,  81 => 25,  79 => 24,  76 => 22,  74 => 21,  72 => 20,  69 => 18,  64 => 14,  62 => 12,  53 => 5,  50 => 4,  42 => 107,  40 => 70,  37 => 69,  35 => 39,  30 => 36,  28 => 4,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "main.html.twig", "/home/rustam/PhpstormProjects/php-exam/src/Views/main.html.twig");
    }
}
