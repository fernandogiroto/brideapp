import { computed, reactive } from "vue";
import { useRoute } from "vue-router";
import router from '@/router'
import axiosInstance from '@/services/api'

// HIDDEN ROUTES
const hiddenRoutes = ["login"];

function hiddenLayouts() {
  const route = useRoute();

  const showLayouts = computed(() => {
    const routeName = route.name;
    return (
      routeName !== null &&
      routeName !== undefined &&
      !hiddenRoutes.includes(routeName.toString())
    );
  });

  return { showLayouts };
}

// BACK PAGE
const goBack = () => {
  eventBus.setTitle('');
  router.back()
}

// EVENT BUS
interface EventBus {
  title: string;
  subtitle: string;
  setTitle: (newTitle: string) => void;
  setSubtitle: (newSubtitle: string) => void;
}
const eventBus: EventBus = reactive({
  title: "",
  subtitle: "",
  setTitle(newTitle: string) {
    this.title = newTitle;
  },
  setSubtitle(newSubtitle: string) {
    this.subtitle = newSubtitle;
  },
});

// eslint-disable-next-line @typescript-eslint/no-explicit-any
const fetchTestData = async (): Promise<string | any> => {
    try {
        const response = await axiosInstance.get('/v1/test');
        if (response.status === 200) {
            return response.data;
        }
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    } catch (error:any) {
        if (error.response && error.response.status === 401) {
            return 'Você não está autenticado. Por favor, faça login novamente.'
        } else {
            console.error('Error fetching test data:', error)
            return 'Ocorreu um erro ao buscar os dados.'
        }
    }
}


export { hiddenLayouts, eventBus, goBack, fetchTestData };
