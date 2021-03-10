<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* extension/opencart/catalog/view/template/module/banner.twig */
class __TwigTemplate_15a5b6994d1b55b58af6abdd3572a5507c83beeffea61bb4a88e96f20ec79da3 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div id=\"carousel-banner";
        echo ($context["module"] ?? null);
        echo "\" class=\"carousel slide";
        if ((($context["effect"] ?? null) == "fade")) {
            echo " carousel-fade";
        }
        echo "\" data-bs-ride=\"carousel\">
  ";
        // line 2
        if ((($context["indicators"] ?? null) && (twig_length_filter($this->env, twig_array_batch(($context["banners"] ?? null), ($context["items"] ?? null))) > 1))) {
            // line 3
            echo "    <ol class=\"carousel-indicators\">
      ";
            // line 4
            $context["banner_row"] = 0;
            // line 5
            echo "      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_array_batch(($context["banners"] ?? null), ($context["items"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["banner"]) {
                // line 6
                echo "        <li data-target=\"#carousel-banner";
                echo ($context["module"] ?? null);
                echo "\" data-slide-to=\"";
                echo ($context["banner_row"] ?? null);
                echo "\"></li>
        ";
                // line 7
                $context["banner_row"] = (($context["banner_row"] ?? null) + 1);
                // line 8
                echo "      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['banner'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 9
            echo "    </ol>
  ";
        }
        // line 11
        echo "  <div class=\"carousel-inner\">
    ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_array_batch(($context["banners"] ?? null), ($context["items"] ?? null)));
        foreach ($context['_seq'] as $context["_key"] => $context["carousel"]) {
            // line 13
            echo "      <div class=\"carousel-item\">
        <div class=\"row justify-content-center\">
          ";
            // line 15
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["carousel"]);
            foreach ($context['_seq'] as $context["_key"] => $context["banner"]) {
                // line 16
                echo "            <div class=\"col-";
                echo twig_round((12 / ($context["items"] ?? null)), ($context["floor"] ?? null));
                echo " text-center\">
              ";
                // line 17
                if (twig_get_attribute($this->env, $this->source, $context["banner"], "link", [], "any", false, false, false, 17)) {
                    // line 18
                    echo "                <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["banner"], "link", [], "any", false, false, false, 18);
                    echo "\"><img src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["banner"], "image", [], "any", false, false, false, 18);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["banner"], "title", [], "any", false, false, false, 18);
                    echo "\" class=\"img-fluid\"/></a>
              ";
                } else {
                    // line 20
                    echo "                <img src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["banner"], "image", [], "any", false, false, false, 20);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["banner"], "title", [], "any", false, false, false, 20);
                    echo "\" class=\"img-fluid\"/>
              ";
                }
                // line 22
                echo "            </div>
          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['banner'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 24
            echo "        </div>
      </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['carousel'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        echo "  </div>
  ";
        // line 28
        if ((($context["controls"] ?? null) && (twig_length_filter($this->env, twig_array_batch(($context["banners"] ?? null), ($context["items"] ?? null))) > 1))) {
            // line 29
            echo "    <a href=\"#carousel-banner";
            echo ($context["module"] ?? null);
            echo "\" class=\"carousel-control-prev\" data-slide=\"prev\"><span class=\"fa fa-chevron-left\"></span></a> <a href=\"#carousel-banner";
            echo ($context["module"] ?? null);
            echo "\" class=\"carousel-control-next\" data-slide=\"next\"><span class=\"fa fa-chevron-right\"></span></a>
  ";
        }
        // line 31
        echo "</div>
<script type=\"text/javascript\"><!--
\$('#carousel-banner";
        // line 33
        echo ($context["module"] ?? null);
        echo " .carousel-indicators li:first').addClass('active');
\$('#carousel-banner";
        // line 34
        echo ($context["module"] ?? null);
        echo " .carousel-inner .carousel-item:first').addClass('active');

\$('#carousel-banner";
        // line 36
        echo ($context["module"] ?? null);
        echo "').carousel({
\tride: 'carousel',
\tinterval: ";
        // line 38
        echo twig_escape_filter($this->env, ($context["interval"] ?? null), "js");
        echo ",
\twrap: true
});
//--></script>
";
    }

    public function getTemplateName()
    {
        return "extension/opencart/catalog/view/template/module/banner.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  163 => 38,  158 => 36,  153 => 34,  149 => 33,  145 => 31,  137 => 29,  135 => 28,  132 => 27,  124 => 24,  117 => 22,  109 => 20,  99 => 18,  97 => 17,  92 => 16,  88 => 15,  84 => 13,  80 => 12,  77 => 11,  73 => 9,  67 => 8,  65 => 7,  58 => 6,  53 => 5,  51 => 4,  48 => 3,  46 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/opencart/catalog/view/template/module/banner.twig", "C:\\xampp_8.0\\htdocs\\craftslane-crm-3.0.3.7\\upload\\extension\\opencart\\catalog\\view\\template\\module\\banner.twig");
    }
}
