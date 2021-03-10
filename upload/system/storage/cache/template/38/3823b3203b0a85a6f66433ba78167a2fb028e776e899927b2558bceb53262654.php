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

/* install/view/template/install/step_4.twig */
class __TwigTemplate_6cd1990a4627d52ccf2223ed8b48b97692d7e732782f7819004a1ea541f7ba95 extends Template
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
        echo ($context["header"] ?? null);
        echo "
<div id=\"content\">
  <div class=\"page-header\">
    <div class=\"container\">
      <h1>";
        // line 5
        echo ($context["heading_title"] ?? null);
        echo "</h1>
    </div>
  </div>
  <div class=\"container\">
    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
        // line 9
        echo ($context["error_warning"] ?? null);
        echo " <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>
    <div class=\"card\">
      <div class=\"card-header\"><i class=\"fas fa-pencil-alt\"></i> ";
        // line 11
        echo ($context["text_step_4"] ?? null);
        echo "</div>
      <div class=\"card-body p-4\">
        <div class=\"row mb-4\">
          <div class=\"col-6 text-center\">
            <a href=\"../\"><img src=\"view/image/catalog.jpg\" alt=\"OpenCart\" title=\"OpenCart\" class=\"img-thumbnail\"/></a><br/>
            <a href=\"../\" class=\"btn btn-outline-secondary mt-3\">";
        // line 16
        echo ($context["text_catalog"] ?? null);
        echo "</a>
          </div>
          <div class=\"col-6 text-center\">
            <a href=\"../admin/\" class=\"mb-3\"><img src=\"view/image/admin.jpg\" alt=\"OpenCart\" title=\"OpenCart\" class=\"img-thumbnail\"/></a><br/>
            <a href=\"../admin/\" class=\"btn btn-outline-secondary mt-3\">";
        // line 20
        echo ($context["text_admin"] ?? null);
        echo "</a>
          </div>
        </div>
        <div class=\"mb-4\">";
        // line 23
        echo ($context["promotion"] ?? null);
        echo "</div>
        <div class=\"m-4 text-center\"><a href=\"https://www.opencart.com/index.php?route=marketplace/extension&utm_source=opencart_install&utm_medium=store_link&utm_campaign=opencart_install\" target=\"_blank\" class=\"btn btn-outline-secondary\">";
        // line 24
        echo ($context["text_extension"] ?? null);
        echo "</a></div>
        <fieldset class=\"mb-5\">
          <legend><i class=\"fa fa-envelope-o\"></i> ";
        // line 26
        echo ($context["text_mail"] ?? null);
        echo "</legend>
          <div class=\"text-center\">
            <p class=\"pb-2\">";
        // line 28
        echo ($context["text_mail_description"] ?? null);
        echo "</p>
            <a href=\"http://newsletter.opencart.com/h/r/B660EBBE4980C85C\" target=\"_BLANK\" class=\"btn btn-primary\"><i class=\"fa fa-envelope-o\"></i> ";
        // line 29
        echo ($context["button_mail"] ?? null);
        echo "</a>
          </div>
        </fieldset>
        <div class=\"row mb-4\">
          <div class=\"col-4 text-center\">
            <h3><a href=\"https://www.facebook.com/opencart/\" target=\"_blank\" class=\"icon transition\"><i class=\"fa fa-facebook\"></i></a> ";
        // line 34
        echo ($context["text_facebook"] ?? null);
        echo "</h3>
            <p>";
        // line 35
        echo ($context["text_facebook_description"] ?? null);
        echo "</p>
            <a href=\"https://www.facebook.com/opencart/\" target=\"_blank\">";
        // line 36
        echo ($context["text_facebook_visit"] ?? null);
        echo "</a>
          </div>
          <div class=\"col-4 text-center\">
            <h3><a href=\"https://forum.opencart.com/?utm_source=opencart_install&utm_medium=forum_link&utm_campaign=opencart_install\" target=\"_blank\" class=\"icon transition\"><i class=\"fa fa-comments\"></i></a> ";
        // line 39
        echo ($context["text_forum"] ?? null);
        echo "</h3>
            <p>";
        // line 40
        echo ($context["text_forum_description"] ?? null);
        echo "</p>
            <a href=\"https://forum.opencart.com/?utm_source=opencart_install&utm_medium=forum_link&utm_campaign=opencart_install\" target=\"_blank\">";
        // line 41
        echo ($context["text_forum_visit"] ?? null);
        echo "</a>
          </div>
          <div class=\"col-4 text-center\">
            <h3><a href=\"https://www.opencart.com/index.php?route=support/partner&utm_source=opencart_install&utm_medium=partner_link&utm_campaign=opencart_install\" target=\"_blank\" class=\"icon transition\"><i class=\"fa fa-user\"></i></a> ";
        // line 44
        echo ($context["text_commercial"] ?? null);
        echo "</h3>
            <p>";
        // line 45
        echo ($context["text_commercial_description"] ?? null);
        echo "</p>
            <a href=\"https://www.opencart.com/index.php?route=support/partner&utm_source=opencart_install&utm_medium=partner_link&utm_campaign=opencart_install\" target=\"_blank\">";
        // line 46
        echo ($context["text_commercial_visit"] ?? null);
        echo "</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
";
        // line 53
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "install/view/template/install/step_4.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  149 => 53,  139 => 46,  135 => 45,  131 => 44,  125 => 41,  121 => 40,  117 => 39,  111 => 36,  107 => 35,  103 => 34,  95 => 29,  91 => 28,  86 => 26,  81 => 24,  77 => 23,  71 => 20,  64 => 16,  56 => 11,  51 => 9,  44 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "install/view/template/install/step_4.twig", "C:\\xampp_8.0\\htdocs\\craftslane-crm-3.0.3.7\\upload\\install\\view\\template\\install\\step_4.twig");
    }
}
