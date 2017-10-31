<?php

/* pagination.html.twig */
class __TwigTemplate_f450ed4fdd164f017c97261687385e905b62b8b39d35013a78b12c5fd2c22a9f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if ((($context["numPages"] ?? null) > 1)) {
            // line 2
            echo "    <div class=\"col-md-12\">
        <nav aria-label=\"Page navigation\" class=\"text-center\">
            <ul class=\"pagination\">
                <li ";
            // line 5
            if ((($context["curPage"] ?? null) < 2)) {
                echo "class=\"hidden\"";
            }
            echo ">
                    <a href=\"";
            // line 6
            echo twig_escape_filter($this->env, ($context["here"] ?? null), "html", null, true);
            echo "?page=";
            echo twig_escape_filter($this->env, (($context["curPage"] ?? null) - 1), "html", null, true);
            echo "\" ";
            if ((($context["curPage"] ?? null) < 1)) {
                echo "class=\"disabled\"";
            }
            echo " aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a>
                </li>
                ";
            // line 8
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, ($context["numPages"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 9
                echo "                    <li ";
                if ((($context["curPage"] ?? null) == $context["i"])) {
                    echo "class=\"active\"";
                }
                echo ">
                        <a href=\"";
                // line 10
                echo twig_escape_filter($this->env, ($context["here"] ?? null), "html", null, true);
                echo "?page=";
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "</a>
                    </li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 13
            echo "                <li ";
            if ((($context["curPage"] ?? null) == ($context["numPages"] ?? null))) {
                echo "class=\"hidden\"";
            }
            echo ">
                    <a href=\"";
            // line 14
            echo twig_escape_filter($this->env, ($context["here"] ?? null), "html", null, true);
            echo "?page=";
            echo twig_escape_filter($this->env, (($context["curPage"] ?? null) + 1), "html", null, true);
            echo "\" ";
            if ((($context["curPage"] ?? null) == ($context["numPages"] ?? null))) {
                echo "class=\"hidden\"";
            }
            echo " aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a>
                </li>
            </ul>
        </nav>
    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "pagination.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 14,  67 => 13,  54 => 10,  47 => 9,  43 => 8,  32 => 6,  26 => 5,  21 => 2,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "pagination.html.twig", "/home/rustam/PhpstormProjects/php-exam/src/Views/pagination.html.twig");
    }
}
